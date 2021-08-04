<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;

use Inertia\Inertia;

use function PHPSTORM_META\type;

class RegisteredUserController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    public function create(Request $request)
    {
        $props = null !== $request->session()->get('status') ? ['status' => $request->session()->get('status')] : [];
        return Inertia::render('admin/Auth/Register', $props);
    }

    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(
        Request $request,
        CreatesNewUsers $creator
    ) {
        preg_match('/[0-9]{3}[\.]{1}[0-9]{3}[\.]{1}[0-9]{3}[\-]{1}[0-9]{2}/', $request->cpf, $match1);
        preg_match('/[0-9]{4}[ ]{1}[0-9]{4}[ ]{1}[0-9]{4}/', $request->titulo_eleitoral, $match2);
        preg_match('/[a-zA-Z]{2}/', $request->uf, $match3);

        if(count($match1) != 1 || count($match2) != 1 || count($match3) != 1){
            return redirect(route('cadastro'))->with('status', [0 => 'Preencha corretamente o campo de UF, CPF e Titulo Eleitoral']);
        }

        event(new Registered($user = $creator->create($request->all())));

        $this->guard->login($user);

        return app(RegisterResponse::class);
    }
}
