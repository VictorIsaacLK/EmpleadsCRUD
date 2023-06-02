<?php
require_once("coneccion.php");

//  valor inicial
$apellido_materno = $_POST['apellido_materno'] ?? "";
$apellido_paterno = $_POST['apellido_paterno'] ?? "";
$nombre = $_POST['nombre'] ?? "";
$edad = $_POST['edad'] ?? "";
$sexo = $_POST['sexo'] ?? "";
$direccion = $_POST['direccion'] ?? "";
$salario = $_POST['salario'] ?? "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- ESTE SCRIPT EN ESPECIFICO TIENE QUE ESTAR AQUI PARA QUE FUNCIONE, LO MOVI UNA VEZ Y CASI MUERO -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <link rel="stylesheet" href="css/tabla.css">
    <title>Agregar</title>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



</head>

<body>
    <?php
    include 'navbar.html';
    ?>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning btn-lg w-25 d-block mx-auto mt-3" data-bs-toggle="modal" data-bs-target="#agregarModal">
        Agregar empleado
    </button>


    <!-- Modal -->
    <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="agregar.php" method="POST" id="agregar-empleado">
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="apellido_materno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Agrega el apellido materno" value="<?php echo $apellido_materno; ?>" required pattern="^[a-zA-Z\s]{1,20}$">
                        </div>
                        <div class="mb-3">
                            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Agrega el apellido paterno" value="<?php echo $apellido_paterno; ?>" required pattern="^[a-zA-Z\s]{1,20}$">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Agrega el nombre" value="<?php echo $nombre; ?>" required pattern="^[a-zA-Z\s]{1,30}$">
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" name="edad" id="edad" placeholder="Agrega la edad" value="<?php echo $edad; ?>" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select class="form-select" aria-label="Default select example" id="sexo" name="sexo" required>
                                <option value="" disabled selected>Elige el sexo del empleado</option>
                                <option value="Femenino" <?php if ($sexo === 'Femenino') echo 'selected'; ?>>Femenino</option>
                                <option value="Masculino" <?php if ($sexo === 'Masculino') echo 'selected'; ?>>Masculino</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Agrega la dirección" value="<?php echo $direccion; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="salario" class="form-label">Salario (Máximo dos decimales)</label>
                            <input type="text" class="form-control" name="salario" id="salario" placeholder="Ej. 200.00" value="<?php echo $salario; ?>" required pattern="^\d+(\.\d{1,2})?$">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="agregar">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Tabla de empleados -->
    <div class="container mt-4">
        <table id="empleados-registrados" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre completo</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Salario</th>
                    <th>Departamento</th>
                    <th>Estado</th>
                </tr>
            </thead>
        </table>
    </div>



    <!-- Modal de autocompletado -->

    <!-- Modal -->
    <div class="modal fade" id="departamentoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar departamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="modificar.php" method="POST" id="agregar-departamento">
                    <div class="modal-body mb-2">
                        <div class="ui-widget">
                            <label for="tags">Departamentos disponibles: </label>
                            <input id="tags" name="tags" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar departamento</button>
                        <input type="hidden" name="empl_id" id="empl_id" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Scripts -->



    <script>
        /* Formatting function for row details - modify as you need */
        function format(d) {
            // `d` is the original data object for the row
            var table = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td style="font-weight:bold">Dirección:</td>' +
                '<td>' +
                d.direccion +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="font-weight:bold">Departamento:</td>' +
                '<td id="departamento_' + d.departamento_id + '">' +
                d.departamento_id +
                '</td>' +
                '</tr>' +
                '</table>';

            $.ajax({
                type: "POST",
                url: "get_departamento.php",
                data: {
                    departamento_id: d.departamento_id
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    $('#departamento_' + d.departamento_id).text(result.nombre);
                }
            });


            return table;
        }




        $(document).ready(function() {
            // Inicializa la tabla con DataTables.
            var table = $('#empleados-registrados').DataTable({
                ajax: {
                    url: 'get_trabajadores.php',
                    dataSrc: ''
                },
                columns: [{
                        data: null,
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.nombre + ' ' + data.apellido_paterno + ' ' + data.apellido_materno;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.edad + ' años';
                        }
                    },
                    {
                        data: 'sexo'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '$' + data.salario;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row) {
                            return '<button value="' + data.id + '" class="btn btn-primary btn-edit custom-btn" data-bs-toggle="modal" data-bs-target="#departamentoModal">Asignar departamento</button>' +
                                '<input type="hidden" name="elim_id" id="elim_id" value="' + data.id + '">';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row) {
                            if (data.status == false) {
                                return '<button class="btn btn-success btn-activate custom-btn" data-id="' + data.id + '">Baja(Activar)</button>';
                            } else {
                                return '<button class="btn btn-danger btn-deactivate custom-btn" data-id="' + data.id + '">Activo (Desactivar)</button>' +
                                    '<input type="hidden" name="elim_id" id="elim_id" value="' + data.id + '">';
                            }
                        }
                    }


                ],
                order: [
                    [1, 'asc']
                ],
                responsive: true,
            });


            $(document).on('click', '.btn-activate', function(e) {
                e.preventDefault();
                var elim_id = $(this).data('id');
                cambiarEstado(elim_id);
            });

            $(document).on('click', '.btn-deactivate', function(e) {
                e.preventDefault();
                var elim_id = $(this).data('id');
                cambiarEstado(elim_id);
            });


            function cambiarEstado(elim_id) {
                $.ajax({
                    url: 'eliminar.php',
                    method: 'POST',
                    data: {
                        elim_id: elim_id
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            //////////////////////////

            // Add event listener for opening and closing details
            $('#empleados-registrados tbody').on('click', 'td.dt-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });


            // Define el evento de envío del formulario.
            $("#agregar-empleado").on("submit", function(event) {
                event.preventDefault();

                var formData = $(this).serialize();



                //Importante tenerlo antes de la peticion ajax, evita que el modal se quede atrapado al momento de hacerlo mas de una vez
                $('#agregarModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

                $.ajax({
                    type: "POST",
                    url: "agregar.php",
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        $("#apellido_materno").val("");
                        $("#apellido_paterno").val("");
                        $("#nombre").val("");
                        $("#edad").val("");
                        $("#sexo").val("");
                        $("#direccion").val("");
                        $("#salario").val("");

                        table.ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            });


            // Eliminar empleado

            $(document).on("submit", ".eliminar-form", function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "eliminar.php",
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        table.ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            });



            //Agregar departamento

            $("#agregar-departamento").on("submit", function(event) {

                event.preventDefault();

                var formData = $(this).serialize();



                //Importante tenerlo antes de la peticion ajax, evita que el modal se quede atrapado al momento de hacerlo mas de una vez
                $('#departamentoModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

                $.ajax({
                    type: "POST",
                    url: "modificar.php",
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        table.ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            });

            // autocompletado de departamentos

            $(function() {
                $.ajax({
                    url: "get_departamentos.php",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        var availableTags = [];

                        for (var i = 0; i < data.length; i++) {
                            console.log(availableTags.push({
                                label: data[i].nombre,
                                value: data[i].nombre,
                                // console: console.log(data[i].nombre)
                            }));
                        }

                        // autocompletado en el input
                        $("#tags").autocomplete({
                            source: availableTags,
                            appendTo: "#departamentoModal"
                        });

                    },
                    error: function() {
                        console.log("Error en la petición AJAX");
                    }
                });
            });


            $(document).ready(function() {
                //  cuando el modal se muestra
                $('#departamentoModal').on('show.bs.modal', function(event) {
                    // "button" es el botón que disparó el evento
                    var button = $(event.relatedTarget);
                    // guarda el valor del boton
                    var idPersona = button.val();

                    // se guarda en el hidden
                    $("#empl_id", this).val(idPersona);
                });
            });

        });
    </script>


    <!-- Bootstrap 5 y ajax scripts-->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>