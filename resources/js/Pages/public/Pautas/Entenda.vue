<template>
    <app-public>
        <article>
            <section class="header">
                <h1>Popularis</h1>
                <h6>A democracia no século XXI</h6>
            </section>
            <section class="body">
                <div>
                    <h3>Resumo</h3>
                    <p></p>
                </div>
                <div>
                    <h3>Introdução</h3>
                    <p></p>
                </div>
                <div>
                    <h3>Objetivos</h3>
                    <ul>
                        <li></li>
                    </ul>
                </div>
                <div>
                    <h3>Metodologia</h3>
                    <div>
                        <h4>Metodologia do projeto</h4>
                        <p></p>
                    </div>
                    <div>
                        <h4>Metodologia de implementação real</h4>
                        <p></p>
                    </div>
                </div>
                <div>
                    <h3>Justificativa</h3>
                    <div>
                        <h4>Embasamento filosófico</h4>
                        <p></p>
                    </div>
                    <div>
                        <h4>Embasamento político</h4>
                        <p></p>
                    </div>
                    <div>
                        <h4>Embasamento científico</h4>
                        <p></p>
                    </div>
                    <div>
                        <h4>Embasamento informático</h4>
                        <p></p>
                    </div>
                </div>
                <div>
                    <h3>Resolução Técnica</h3>
                    <div>
                        <h4>Tipos de usuários</h4>
                        <p></p>
                    </div>
                    <div>
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
                    </div>
                    <div>
                        <h4>Fraude</h4>
                        <div>
                            <h5>Fraude do usuário</h5>
                            <p>
                                Afim de aumentar a segurança, o usuário
                                precisará fazer o upload do seu documento de
                                identidade para evitar a criação de contas
                                falsas ou sem autorização. O scan desse
                                documento e a sua validação pode ser realizada
                                utilizando visão computacional a partir de uma
                                inteligência artificial no servidor. Trata-se de
                                uma solução viável e amplamente utilizada no
                                mercado de TI.
                            </p>
                        </div>
                        <div>
                            <h5>Fraude do administrador</h5>
                            <p>
                                O administrador não fica completamente
                                inviabilizado de fraudar as votações que
                                ocorrem, contudo a aplicação guarda um histórico
                                de todas as votações feitas pelo usuário. Dessa
                                forma, ainda que o administrador fraude a
                                votação, cada eleitor terá acesso ao seu
                                histórico de votação, possibilitando assim uma
                                recontagem. Além disso, é recomendado que, em
                                caso de implementação, seja habilitado ao
                                usuário o download do seu histórico em formato
                                de PDF.
                            </p>
                        </div>
                    </div>
                    <div>
                        <h4>Proteção dos dados</h4>
                        <p></p>
                    </div>
                </div>
                <div>
                    <h3>Funcionamento da aplicação</h3>
                    <p></p>
                </div>
                <div>
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
article{
    margin: 5.5vw auto 8vw auto;

    .header{
        h1{
            @include Title2;
            font-size: 34px;
        }
        h6{
            @include Title3;
            font-size: 18px;
        }
    }
}
</style>
