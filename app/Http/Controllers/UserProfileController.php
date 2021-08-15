<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Show the general profile settings screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function show(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Profile/Show', [
            'sessions' => $this->sessions($request)->all(),
        ]);
    }

    /**
     * Get the current sessions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function sessions(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', $request->user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);

            return (object) [
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return \Jenssegers\Agent\Agent
     */
    protected function createAgent($session)
    {
        return tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }


    public function votes(Request $request)
    {
        if (null === $request->session()->get('pagination')) {
            $votes = Auth::user()->neg_votes . Auth::user()->pos_votes;
            $votes_id = explode('-', $votes);

            $total_pautas = count(DB::table('pautas')->whereIn('id', $votes_id)->get());
            $db_data = DB::table('pautas')->whereIn('id', $votes_id)->take(5)->get();

            $message = count($db_data) > 0 ? [0 => "Votos encontrados!"] : [0 => "Votos não encontrados. Se acha que isso é um erro, entre em contato conosco."];
            return Inertia::render('admin/profile/MeusVotos', ['total_pautas' => $total_pautas, 'db_data' => [$db_data], 'status' => $message]);
        }
        else{
            $pagination = $request->session()->get('pagination');
            $db_data = $pagination[0];
            $total_pautas = $pagination[1];

            $message = count($db_data) > 0 ? [0 => "Votos encontrados!"] : [0 => "Votos não encontrados. Se acha que isso é um erro, entre em contato conosco."];
            return Inertia::render('admin/profile/MeusVotos', ['total_pautas' => $total_pautas, 'db_data' => [$db_data], 'status' => $message]);
        }
    }
}
