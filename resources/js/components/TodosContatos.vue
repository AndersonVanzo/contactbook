<template>
    <div class="container" id="main-content">
        <div id="conteudo" class="text-center shadow-lg p-3 mb-5 bg-white rounded">
            <div id="title">
                <h1>Agenda</h1>
            </div>

            <div class="row justify-content-center" style="margin: 2.5% 0;">
                <button type="submit" class="btn" @click.prevent="novo">Novo Contato</button>
            </div>

            <div v-for="contato in contatos" :key="contato.id">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="row contato">
                            <div class="col-2 contato-img">
                                <img src="" class="img-fluid img-thumbnail rounded-circle foto" alt="Foto do Contato">
                                <!-- :src="require('../assets/default-user.png')" -->
                            </div>

                            <script type="javascript">
                                var source = document.getElementByClass('foto');
                                source.src = '../../'+{{contato.foto}};
                                console.log({{contato.foto}})
                            </script>

                            <div class="col-8 contato-dados">
                                <p>
                                    C:\Users\ander\Documents\GitHub\contatosSPA\storage\default-user.png
                                    <span>{{contato.foto}}</span>
                                    <span>{{ contato.nome }}</span><br>
                                    <span>{{ contato.numero }}</span><br>
                                    <span>{{ contato.endereco }}</span><br>
                                    <span>{{ contato.nascimento }}</span>
                                </p>
                            </div>
                            <div class="col-2 contato-acao">
                                <router-link :to="{name: 'edit', params: { id: contato.id }}">
                                    <b-icon-pencil-square class="icon"></b-icon-pencil-square>
                                </router-link>
                                <b-icon-x-circle class="icon" @click="deleteContato(contato.id)"></b-icon-x-circle>
                           </div>
                        </div>
                   </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            contatos: []
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/contatos/')
            .then(response => {
                this.contatos = response.data;
            });
    },
    methods: {
        novo() {
            this.$router.push({name:'create'});
        },
        deleteContato(id) {
            this.axios
                .delete(`http://localhost:8000/api/contatos/${id}`)
                .then(response => {
                    let i = this.contatos.map(data => data.id).indexOf(id);
                    this.contatos.splice(i, 1);
                });
        }
    },
}
</script>

<style>

    #main-content {
        height: 100%;
        width: 100%;
        padding: 2% 0;
    }

    #title {
        padding: 3%;
    }

    #conteudo {
        position: relative;
        padding: 2%;
        background: rgba(223, 230, 237, 0.5) !important;
        border-radius: 6px;
    }

    #conteudo::after {
        content: '';
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border-radius: 5px;
        pointer-events: none;
        background: linear-gradient(to bottom,rgba(255,255,255,0.2) 0%, transparent 100%);
    }

    .contato {
        position: relative;
        display: flex;
        align-items: center;
        margin: 1%;
        padding: 2%;
        background: rgba(223, 230, 237, 0.5) !important;
        border-radius: 6px;
        border: 3px solid #d2cff7;
    }

    .contato, .contato-img, .contato-dados, .contato-acao {
        padding: 1%;
    }

    .contato-dados, .contato-acao {
        text-align: left;
        font-weight: 600;
    }

    .icon {
        font-size: 2rem;
        margin: 5%;
    }

    button {
        background-color: #6558F5 !important;
        color: #fff !important;
    }

    button:hover {
        background-color: #4C42B6 !important;
        color: #fff !important;
    }

</style>