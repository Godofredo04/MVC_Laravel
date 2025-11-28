<html>
    <head>
    </head>
    <body>
        <form action="{{ route('articulos.store') }}" method="POST">
            @csrf
            <p>
                <label for="id_art">ID del Artículo</label>
                <input type="text" required id="id_art" name="id_art">
            </p>
            <p>
                <label for="titulo" >Nombre del artículo</label>
                <input type="text" id="titulo" name="titulo">
            </p>
            <p>
                <label for="descripcion">Descripción del Artículo</label>
                <input type="text" id="descripcion" name="descripcion">
            </p>
            <p>
                <input type="submit" value="Añadir artículo"> 
            </p>
        </form>
    </body>
</html>