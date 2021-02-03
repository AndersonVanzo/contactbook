<template>
    <div class="container" id='main-content'>
        <div id="novo" class=''>
            <div id="title" class="text-center">
                <h1>Editar Contato</h1>
            </div>

            <div class="container-fluid text-left">
                <form @submit.prevent="updateContato" enctype="multipart/form-data">

                    <div class="form-group">
                        <input class="form-control-file" type="file" @change="imageChange">
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input class="form-control" type="text" v-model="contato.nome" placeholder="Nome do contato">
                    </div>

                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input class="form-control" type="text" v-model="contato.numero" placeholder="(xx) xxxxx-xxxx" @blur="mascara" @focus="hifen">
                    </div>

                    <div class="form-group">
                        <label for="email">Endereço:</label>
                        <input class="form-control" type="text" v-model="contato.endereco" placeholder="ex.: Rua das Ameixas, 20, Bairro Floresta">
                    </div>

                    <div class="form-group">
                        <label for="datepicker">Data de Nascimento</label>
                        <b-form-datepicker id="datepicker" v-model="contato.nascimento" class="mb-2"></b-form-datepicker>
                    </div>

                    <div class="row">
                        <button class="btn" type="submit" id="salvar">Salvar</button>
                    </div>
                </form>

                <div class="row">
                        <button class="btn" id="cancelar" @click.prevent="cancelar">Cancelar</button>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'NovoComponent',
    data(){
        return {
            image: '',
            contato: {}
        }
    },
    created() {
        this.axios
            .get(`http://localhost:8000/api/contatos/${this.$route.params.id}`)
            .then((res) => {
                this.contato = res.data;
            });
    },
    methods: {
        imageChange(e) {
            this.image = e.target.files[0];
        },
        updateContato() {
            this.contato.foto = this.image;
            let form = new FormData();
            const config = {
                headers: {
                'content-type': 'multipart/form-data',
                }
            }
            form.append('nome', this.contato.nome);
            form.append('numero', this.contato.numero);
            form.append('endereco', this.contato.endereco);
            form.append('nascimento', this.contato.nascimento);
            form.append('foto', this.image);
            this.axios
                .patch(`http://localhost:8000/api/contatos/${this.$route.params.id}`, form, config)
                .then((response) => {
                    this.$router.push({ name: 'home' });
                });
        },
        cancelar(){
            this.$router.push({name:'home'});
        },
        mascara(e) {
            const atual = e.target.value;
            let final;
            if(atual.length === 11) {
                const parte1 = atual.slice(0,2);
                const parte2 = atual.slice(2,7);
                const parte3 = atual.slice(7,11);
                final = `(${parte1})${parte2}-${parte3}`;
            } else if (atual.length === 9) {
                const parte1 = atual.slice(0,5);
                const parte2 = atual.slice(5,9);
                final = `${parte1}-${parte2}`;
            } else {
                const parte1 = atual.slice(0,4);
                const parte2 = atual.slice(4,8);
                final = `${parte1}-${parte2}`;
            }

            e.target.value = final;
        },
        hifen(e) {
            const atual = e.target.value;
            const final = atual.replace(/\-/g, '');

            e.target.value = final;
        }
    }
    
}
</script>

<style scoped>
    #main-content {
        min-height: 100vh;
        width: 100%;
        padding: 2% 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #novo {
        min-width: 50%;
        padding: 2% 5%;
        position: relative;
        background: rgba(223, 230, 237, 0.5) !important;
        border-radius: 6px;
    }

    #novo::after {
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

    input {
        border: none;
    }

    button {
        margin: 1% auto;
        width:120px;
    }

    #criar{
        background-color: #6558F5 !important;
    }

    #criar:hover {
        background-color: #4C42B6 !important;
    }

    #cancelar{
        background-color: #818181 !important;
    }

    #cancelar:hover {
        background-color: #636363 !important;
    }

    a {
        color: #6558F5;
    }

    a:hover {
        text-decoration: none;
        color: #4C42B6;
    }
</style>