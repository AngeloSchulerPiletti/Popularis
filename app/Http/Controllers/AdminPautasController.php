<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pauta;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AdminPautasController extends Controller
{
    protected function tagHTMLconstructor($content, $codified_text, $text, $tag, $class = "")
    {
        foreach ($codified_text as $i => $value) {
            $content = str_replace($value, '<' . $tag . ' class="' . $class . '" ' . '>' . $text[$i] . '</' . $tag . '>', $content);
        }
        return $content;
    }

    static public function stringToURL($title)
    {
        $changes = array(
            'Š' => 's', 'š' => 's', 'Ð' => 'dj', '' => 'z', '' => 'z', 'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ã' => 'a', 'Ä' => 'a',
            'Å' => 'a', 'Æ' => 'a', 'Ç' => 'c', 'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'Ì' => 'i', 'Í' => 'i', 'Î' => 'i',
            'Ï' => 'i', 'Ñ' => 'n', 'Ń' => 'n', 'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Õ' => 'o', 'Ö' => 'o', 'Ø' => 'o', 'Ù' => 'u',
            'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'Ý' => 'y', 'Þ' => 'b', 'ß' => 'ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i',
            'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ń' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
            'ă' => 'a', 'î' => 'i', 'â' => 'a', 'ș' => 's', 'ț' => 't', 'Ă' => 'A', 'Î' => 'I', 'Â' => 'A', 'Ș' => 'S', 'Ț' => 'T',
            //Another Chars
            ' ' => '-', '!' => '', '?' => '', '+' => '', '/' => '-', '"' => '', "'" => '', '*' => '', '&' => '', '@' => '', '#' => '',
            '(' => '', ')' => '', '¨' => '', ',' => '', '.' => '', '§' => '', '%' => '', '<' => '', '>' => '', '\\' => '', '|' => '',
            //Uppercase to Lowercase
            'A' => 'a', 'B' => 'b', 'C' => 'c', 'D' => 'd', 'E' => 'e', 'F' => 'f', 'G' => 'g', 'H' => 'h', 'I' => 'i',
            'J' => 'j', 'K' => 'k', 'L' => 'l', 'M' => 'm', 'N' => 'n', 'O' => 'o', 'P' => 'p', 'Q' => 'q', 'R' => 'r',
            'S' => 's', 'T' => 't', 'U' => 'u', 'V' => 'v', 'W' => 'w', 'X' => 'x', 'Y' => 'y', 'Z' => 'z',
        );

        $url = strtr($title, $changes);
        return $url;
    }

    public function AutorRegEx($autores){
        $autores_after = preg_split('/[\s]*[,][\s]*/', $autores);

        for ($i=0; $i < count($autores_after); $i++) { 
            preg_match('/^[\s]*$/', $autores_after[$i], $matches);
            if(count($matches) > 0){
                unset($autores_after[$i]);
            }
        }
        return $autores_after;
    }

    public function PVRegEx($words){
        $words_after = preg_split('/[\s,]+/', $words);

        for ($i=0; $i < count($words_after); $i++) { 
            preg_match('/^[\s]*$/', $words_after[$i], $matches);
            if(count($matches) > 0){
                unset($words_after[$i]);
            }
        }
        return $words_after;
    }

    public function PautaRegEx($text){
        $unicode_n = "\u{000A}";
        $last_char = substr($text, -1);
        $text = substr_replace($text, ($last_char.$unicode_n), -1, 1);


        //Simple Paragraph
        preg_match_all("/[@]{2}(.+)[\n]/Us",                               $text, $simple_p);
        $text = $this->tagHTMLconstructor($text, $simple_p[0], $simple_p[1], 'p', 'simple_p');



        /* BOLD  */
        preg_match_all("/[\*]{2}([^\*].*[^\*])[\*]{2}/Us",          $text, $bolds);
        $text = $this->tagHTMLconstructor($text, $bolds[0], $bolds[1], 'strong');

        /* ITALIC */
        preg_match_all(   "/[\*]([^\*].*[^\*])[\*]/Us",                               $text, $italics);
        $text = $this->tagHTMLconstructor($text, $italics[0], $italics[1], 'em');



        /* TITLES */
        //H6
        preg_match_all("/[#]{6}([^#]+)([\n])/U",                       $text, $h6);
        $text = $this->tagHTMLconstructor($text, $h6[0], $h6[1], 'h6');
        //H5
        preg_match_all("/[#]{5}([^#]+)([\n])/U",                       $text, $h5);
        $text = $this->tagHTMLconstructor($text, $h5[0], $h5[1], 'h5');
        //H4
        preg_match_all("/[#]{4}([^#]+)([\n])/U",                       $text, $h4);
        $text = $this->tagHTMLconstructor($text, $h4[0], $h4[1], 'h4');
        //H3
        preg_match_all("/[#]{3}([^#]+)([\n])/U",                       $text, $h3);
        $text = $this->tagHTMLconstructor($text, $h3[0], $h3[1], 'h3');
        //H2
        preg_match_all("/[#]{2}([^#]+)([\n])/U",                       $text, $h2);
        $text = $this->tagHTMLconstructor($text, $h2[0], $h2[1], 'h2');
        //H1
        preg_match_all("/([#]{1}([^#]+))[\n]/U",                       $text, $h1);
        $text = $this->tagHTMLconstructor($text, $h1[1], $h1[2], 'h1');


        //HR
        preg_match_all("/[+][-][+]/Us",          $text, $hrs);
        foreach ($hrs[0] as $i => $value) {
            $text = str_replace($value, '<hr class="elegant_hr"/>', $text);
        }


        /* SPANs */
        // 50%
        // preg_match_all("/[\^]{2}([^\^]+)[\^]{2}/U",                  $text, $small75);
        // $text = $this->tagHTMLconstructor($text, $small75[0], $small75[1], 'span', 'small75');
        // 25%
        // preg_match_all("/[\^]([^\^]+)[\^]/U",                        $text, $small50);
        // $text = $this->tagHTMLconstructor($text, $small50[0], $small50[1], 'span', 'small50');


        /*LISTS */
        //Cria a Lista
        preg_match_all("/[-]{3}[\n](.*)[-]{3}[\n]/Us",                                             $text, $list);
        $text = $this->tagHTMLconstructor($text, $list[0], $list[1], 'ul');
        //Cria os elementos
        preg_match_all("/[-]{2}(.*)[\n]/Us",                                             $text, $list_el);
        $text = $this->tagHTMLconstructor($text, $list_el[0], $list_el[1], 'li');


        /*BASIC FORMAT */
        //Backspaces
        preg_match_all("/\n/Us",          $text, $backspaces);
        foreach ($backspaces[0] as $i => $value) {
            $text = str_replace($value, '<br/>', $text);
        }


        return $text;
    }




    public function create_pauta(Request $request)
    {
        $request->validate([
            'titulo'         => 'required|string|max:150',
            'assunto'        => 'required|string|max:20',
            'autores'        => 'required|string|',
            'palavras_chave' => 'required|string|max:800',
            'resumo'         => 'required|string|max:1000',
            'pauta'          => 'required|string',
        ]);
        
        $palavras_chave = $this->PVRegEx($request->palavras_chave);

        $text = $this->PautaRegEx($request->pauta);
        $responsavel = Auth::user()->id;
        $escopo = Auth::user()->politico_tipo == 1 ? "estadual" : "federal";
        $autores = $this->AutorRegEx($request->autores);
        
        $url = $this::stringToURL($request->titulo);
        $url .= DB::table('pautas')->where('url', $url)->first() ? date('-d-m-Y-his') : "";
        

        $final_date = mktime(0, 0, 0, date('m')+3, date('d'), date('Y'));
        $final_date = date('d-m-Y', $final_date);


        $pauta = new Pauta();
        $pauta->palavras_chave = implode('-', $palavras_chave);
        $pauta->pauta = $text;
        $pauta->responsavel = $responsavel;
        $pauta->escopo = $escopo;
        $pauta->autores = implode('-', $autores);
        $pauta->url = $url;
        
        $pauta->titulo = $request->titulo;
        $pauta->assunto = $request->assunto;
        $pauta->local = Auth::user()->uf;
        $pauta->resumo = $request->resumo;
        $pauta->final_date = $final_date;

        $pauta->save();

        return Inertia::render('admin/politico/CriadorPautas', ['status' => [0 => 'Pauta criada com sucesso, aguardando análise!']]);
    }
}
