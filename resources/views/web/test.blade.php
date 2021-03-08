<!DOCTYPE html>
<html>

<head>
    <title>My first Vue app</title>
    {{--<script src="https://unpkg.com/vue"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>

<body>
    {{-- componente texto --}}
    <div id="app">
        <p>@{{ message }}</p>
        <input v-model="message">
    </div>

    {{-- componente bucle --}}
    <div id="app-4">
        <ol>
            <li v-for="todo in todos">
                @{{ todo.text }}
            </li>
        </ol>

        {{-- Controles para editar bucle --}}
        <div>
            <label for="entrada"></label>
            <input v-model="message" type="text" id="entrada">
            <button v-on:click="entrada_texto">añadir texto</button>
        </div>
    </div>



    <script>
        //componente texto
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!'
            }
        });

        //componente bucle
        var app4 = new Vue({
            el: '#app-4',
            data: {
                todos: [
                    { text: 'Learn JavaScript' },
                    { text: 'Learn Vue' },
                    { text: 'Build something awesome' }
                ],
                message: ''
            },
            methods: {
                entrada_texto: function(){
                    this.todos.push({ text: this.message })
                    this.message = '';
                }
            }
        });

    </script>
</body>

</html>
