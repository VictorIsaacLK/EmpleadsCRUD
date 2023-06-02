<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            var availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
            ];
            $("#tags").autocomplete({
                source: availableTags
            });
        });
    </script>
</head>

<body>
    <div class="ui-widget">
        <label for="tags">Tags: </label>
        <input id="tags" class="ui-autocomplete-input" autocomplete="off">
    </div>
</body>



<script>
    function format(d) {
        // `d` is the original data object for the row
        return (
            '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td style="font-weight:bold">Dirección:</td>' +
            '<td>' +
            d.direccion +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="font-weight:bold">Departamento:</td>' +
            '<td>' +
            d.departamento_id +
            '</td>' +
            '</tr>' +
            '</table>'
        );
    }




















    colum: [{
        data: null,
        orderable: false,
        render: function(data, type, row) {
            return '<form class="eliminar-form" action="eliminar.php" method="POST">' +
                '<button type="submit" class="btn btn-danger btn-delete custom-btn">Eliminar</button>' +
                '<input type="hidden" name="elim_id" id="elim_id_' + data.id + '" value="' + data.id + '">' +
                '</form>';
        }
    }]
</script>

<input type="hidden" name="elim_id" id="elim_id" value="' + data.id + '">
</html>