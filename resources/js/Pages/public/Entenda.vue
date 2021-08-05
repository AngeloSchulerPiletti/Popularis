<template>
    <app-public>
        <article>
            <section class="header">
                <h1>Democracia do século XXI</h1>
                <h6>Popularis, onde todos realmente têm voz</h6>
            </section>
            <section class="body">
                <div class="subject">
                    <h3>Resumo</h3>
                    <p></p>
                </div>
                <div class="subject">
                    <h3>Introdução</h3>
                    <p></p>
                </div>
                <div class="subject">
                    <h3>Objetivos</h3>
                    <ul>
                        <li></li>
                    </ul>
                </div>
                <div class="subject">
                    <h3>Metodologia</h3>
                    <div class="topic">
                        <h4>Metodologia do projeto</h4>
                        <p></p>
                    </div>
                    <div class="topic">
                        <h4>Metodologia de implementação real</h4>
                        <p></p>
                    </div>
                </div>
                <div class="subject">
                    <h3>Justificativa</h3>
                    <div class="topic">
                        <h4>Embasamento filosófico</h4>
                        <p></p>
                    </div>
                    <div class="topic">
                        <h4>Embasamento político</h4>
                        <p></p>
                    </div>
                    <div class="topic">
                        <h4>Embasamento científico</h4>
                        <p></p>
                    </div>
                    <div class="topic">
                        <h4>Embasamento informático</h4>
                        <p></p>
                    </div>
                </div>
                <div class="subject">
                    <h3>Resolução Técnica</h3>
                    <div class="topic">
                        <h4>Tipos de usuários</h4>
                        <p>
                            Em relação aos tipos de usuários presentes na
                            aplicação, existem 3:
                        </p>
                        <ul class="list">
                            <li>Técnico</li>
                            <li>Político</li>
                            <li>Eleitor</li>
                        </ul>
                        <div class="subtopic">
                            <h5>Técnico</h5>
                            <p>
                                A função desse usuário é dar manutenção na
                                plataforma e conseguir agir na base de dados dos
                                usuários. Seus privilégios ainda são tema de
                                muita discussão, mas a divisão de
                                <em>níveis de</em> administrador dessa categoria
                                são: <b>1 -</b> Nível baixo; <b>2 -</b> Nível
                                médio; <b>3 -</b> Nível Alto;
                            </p>
                            <p>
                                Para poder desempenhar essas funções, foi criada
                                uma <em>dashboard</em> que facilita seu acesso a
                                algumas ferramentas da aplicação
                            </p>
                            <p>Todos privilégios de um Eleitor, com excessão daqueles relacionados a votação.</p>
                        </div>
                        <div class="subtopic">
                            <h5>Político</h5>
                            <p>
                                Esse tipo de usuário tem o poder de criar pautas
                                para serem votadas, para desempenhar essa
                                função, ele possui acesso a uma
                                <em>dashboard</em> com diversas ferramentas.
                            </p>
                            <p>Possui todos os privilégios de um Eleitor.</p>
                        </div>
                        <div class="subtopic">
                            <h5>Eleitor</h5>
                            <p>
                                Esse usuário é o Eleitor, seu único (mas o mais
                                importante) poder é votar em pautas. O eleitor
                                também tem acesso à sua conta, seus votos
                                passados, entre outras funções.
                            </p>
                        </div>
                    </div>
                    <div class="topic">
                        <h4>Anonimato do voto</h4>
                        <p>
                            O anonimato do voto é garantido porque não é salva
                            nenhuma informação específica do eleitor. Ao votar,
                            a requisição que carrega o voto é autenticada e, de
                            todas as informações do usuário passadas na
                            requisição, apenas o voto em si é adicionado à
                            tabela da pauta em questão. Entretanto, o voto fica
                            salvo na conta usuário. A razão disso é para se
                            evitar fraudes. Isso é descorrido melhor no tópico
                            <strong>Fraude do Administrador</strong>.
                        </p>
                        <p>
                            Contudo, a maneira ideal de isso ser realizado (e a
                            mais segura até então) seria com a utilização de um
                            sistema de <strong>blockchain</strong>. Nesse
                            sistema, o servidor do governo será responsável por
                            autenticar cada voto que será representado por um
                            <strong>NFT</strong> (Token Não Fungível). Nesse
                            sistema, fica praticamente impossível frudar a
                            votação no sentido de se omitir ou editar votos
                            (considerando as tecnologias de hoje).
                        </p>
                        <p>
                            Nesse caso, o anonimato se deve pelo fato de que o
                            token ficará guardado em qualquer wallet do eleitor,
                            enquanto que o Estado terá apenas a contagem dos
                            votos em seu servidor, dessa forma, em caso de
                            fraude, a leitrua da
                            <strong>blockchain</strong> mostrará a verdade.
                        </p>
                    </div>
                    <div class="topic">
                        <h4>Fraude</h4>
                        <div class="subtopic">
                            <h5>Fraude do usuário</h5>
                            <p>
                                Afim de aumentar a segurança, o usuário
                                precisará fazer o upload do seu documento de
                                identidade para evitar a criação de contas
                                falsas ou sem autorização. O scan desse
                                documento e a sua validação pode ser realizada
                                utilizando
                                <strong><em>visão computacional</em></strong> a
                                partir de uma
                                <em>inteligência artificial</em> no servidor.
                                Trata-se de uma solução viável e amplamente
                                utilizada no mercado de TI.
                            </p>
                        </div>
                        <div class="subtopic">
                            <h5>Fraude do administrador</h5>
                            <p>
                                O administrador não fica completamente
                                inviabilizado de fraudar as votações que ocorrem
                                no sistema utilizado no protóripo, contudo a
                                aplicação guarda um histórico de todas as
                                votações feitas pelo usuário. Dessa forma, ainda
                                que o administrador fraude a votação, cada
                                eleitor terá acesso ao seu histórico de votação
                                (caso o banco de dados mantenha sua
                                integridade), possibilitando assim uma
                                recontagem. Além disso, é recomendado que, em
                                caso de implementação, seja habilitado ao
                                usuário o download do seu histórico em formato
                                de PDF.
                            </p>
                            <p>
                                Todavia, retomando a questão da
                                <strong>blockchain</strong> abordada no tópico
                                "<em>Anonimato do Voto</em>", a criação de
                                <strong>NFTs</strong> como representações do
                                voto traz segurança no escopo de impossibilidade
                                de editar ou remover <em>blocos</em> na
                                <strong>blockchain</strong>.
                            </p>
                            <p>
                                Em relação a criação de novos <em>blocos</em>,
                                nada impede que isso sejá feito, porém se a
                                aplicação possuir uma base de dados com 200mi de
                                usuários, como seria possivel que 202mi votaram?
                                Por conta dessa relação lógica óbvia, essa não é
                                uma preocupação.
                            </p>
                        </div>
                    </div>
                    <div class="topic">
                        <h4>Proteção dos dados</h4>
                        <p>
                            A proteção dos dados dos usuários será uma
                            responsabilidade do sistema do governo, entretanto,
                            são poucas as informações que podem ser acessadas
                            caso haja uma invasão. A maior preocupação seria com
                            a foto do documento scaneado.
                        </p>
                        <p>
                            No âmbito dos <strong>NFTs</strong> representantes
                            do voto, eles estarão com o usuário em alguma
                            <strong><em>wallet</em></strong> de sua escolha,
                            assim, a responsabilidade sobre a preservação da
                            segurança do <strong>NFT</strong> é inteiramente do
                            usuário.
                        </p>
                        <p>
                            Dessa forma, levando em consideração o fato de que o
                            único dado guardado de uma votação no banco de dado
                            é o número de votos, não existem riscos de
                            privacidade quanto a isso. Além do mais, trata-se de
                            uma informação pública.
                        </p>
                    </div>
                </div>
                <div class="subject">
                    <h3>Funcionamento da aplicação</h3>
                    <p></p>
                </div>
                <div class="subject">
                    <h3>Conclusão</h3>
                    <p></p>
                </div>
            </section>
        </article>
    </app-public>
</template>

<script>
import AppPublic from "@/Layouts/AppPublic";
export default {
    components: {
        AppPublic,
    },
};
</script>

<style lang="scss" scoped>
article {
    margin: 5.5vw auto 8vw auto;

    em {
        font-style: italic;
    }
    strong {
        font-weight: 700;
    }

    .header {
        display: flex;
        flex-direction: column;
        align-items: center;

        margin-bottom: 4vw;

        h1 {
            @include Title2;
            font-size: 34px;
            color: $blue;

            line-height: 105%;
        }
        h6 {
            @include Font2_I;
            font-size: 20px;
            color: $blue1;
        }
    }
    .body {
        display: flex;
        flex-direction: column;
        padding: 0 10vw 0 10vw;

        .subject {
            margin: 1.4vw 0 1.4vw 0;
            &:last-child {
                margin: 1.4vw 0 2.8vw 0;
            }
            &:first-child {
                margin: 2.8vw 0 1.4vw 0;
            }

            h3 {
                @include Title2;
                font-size: 22px;
                color: $blue;
            }
            p {
                @include Font0;
                font-size: 16px;
                text-align: justify;
                text-indent: 2em;
            }
            .topic {
                margin: 1.4vw 0 1.4vw 1.5vw;
                &:last-child {
                    margin: 1.4vw 0 2.8vw 1.5vw;
                }
                &:first-child {
                    margin: 2.8vw 0 1.4vw 1.5vw;
                }

                h4 {
                    @include Title3;
                    font-size: 20px;
                    color: lighten($blue, 8%);
                }
                ul {
                    @include Font0;
                    font-size: 15px;
                    display: flex;
                    flex-direction: column;
                    gap: 2px;
                    margin: 6px 0 6px 0;

                    li {
                        border-left: 2px solid $blue;
                        padding-left: 6px;
                        margin-left: 2em;
                    }
                }
                .subtopic {
                    margin: 0.7vw 0 0.7vw 3vw;

                    &:last-child {
                        margin: 0.7vw 0 1.4vw 3vw;
                    }
                    &:first-child {
                        margin: 1.4vw 0 0.7vw 3vw;
                    }
                    h5 {
                        @include Title4;
                        font-style: italic;
                        font-size: 18px;
                        color: $blue1;
                    }
                }
            }
        }
    }
}
</style>
