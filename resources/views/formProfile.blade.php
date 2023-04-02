<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <link rel="stylesheet" href="../assets/css/style.css">


</head>

<body>


    <div class="section ">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <div class="card-3d-wrap mx-autoo">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <form action="{{ route('registerProfile') }}" method="POST"
                                            enctype="multipart/form-data">
                                            <div class="section text-center">
                                                @csrf
                                                <h4 class="mb-4 pb-3">Registro</h4>
                                                <div class="form-group">
                                                    <input type="text" name="Nombres" class="form-style"
                                                        placeholder="Nombre(s)*" id="logname" autocomplete="off"
                                                        required>
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="apellidop" class="form-style"
                                                        placeholder="Apellido paterno" id="logemail" autocomplete="off"
                                                        required>
                                                    <i class="input-icon uil uil-user-square"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="apellidom" class="form-style"
                                                        placeholder="Apellido materno" id="logpass" autocomplete="off"
                                                        required>
                                                    <i class="input-icon uil uil-user-square"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="file" name="image" class="form-style"
                                                        placeholder="Archivo" id="logpass" autocomplete="off"
                                                        required>
                                                    <i class="input-icon uil uil-image"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <select name="pais" class="form-style" id="pais">
                                                        <option value="" selected disabled>Selecciona un pais
                                                        </option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{ $country->id }}">{{ $country->Pais }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <i class="input-icon uil uil-map-marker-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <select name="estado" class="form-style" id="estado">
                                                        <option value="" selected disabled>Selecciona un Estado
                                                        </option>
                                                        <option value=""></option>
                                                    </select>
                                                    <i class="input-icon uil uil-map"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <select name="municipio" class="form-style" id="municipio">
                                                        <option value="" selected disabled>Selecciona un Municipio
                                                        </option>
                                                        <option value=""></option>
                                                    </select>
                                                    <i class="input-icon uil uil-map"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="number" name="numeroCalle" class="form-style"
                                                        placeholder="Numero de calle" id="logpass" autocomplete="off"
                                                        required>
                                                    <i class="input-icon uil uil-directions"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="calle" class="form-style"
                                                        placeholder="Calle" id="logpass" autocomplete="off" required>
                                                    <i class="input-icon uil uil-directions"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="colonia" class="form-style"
                                                        placeholder="Colonia" id="logpass" autocomplete="off"
                                                        required>
                                                    <i class="input-icon uil uil-location-point"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="number" name="codigoPostal" class="form-style"
                                                        placeholder="Codigo postal" id="numeroCP" required>
                                                    <i class="input-icon uil uil-parcel"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">Enviar</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.js"
        integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#pais').on('change', function() {
            var country_id = $(this).val();
            $.ajax({
                url: '{{ route('consultaAjax') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    country_id: country_id
                },
                success: function(response) {
                    var selectEstado = $('#estado');
                    selectEstado.empty();
                    $.each(response, function(key, value) {
                        selectEstado.append('<option value="' + value.id + '">' + value.Estado +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    // Agrega aquí la lógica para manejar el error
                }
            });
        });
        $('#estado').change(function() {
            var state_id = $(this).val();
            $.ajax({
                url: '{{route('getMunicipios')}}',
                type: 'GET',
                dataType: 'json',
                data: {
                    state_id: state_id
                },
                success: function(response) {
                    var municipiosSelect = $('#municipio');
                    municipiosSelect.empty();
                    $.each(response, function(key, value) {
                        municipiosSelect.append('<option value="' + value.id + '">' +
                            value.Nombre + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    // Agrega aquí la lógica para manejar el error
                }
            });
        });
    </script>

    <!-- partial
    <script src="./script.js"></script>
    -->

</body>

</html>
