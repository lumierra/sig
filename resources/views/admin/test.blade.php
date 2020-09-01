<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add or Remove Input Fields Dynamically using jQuery - MyNotePaper</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="container"style="max-width: 700px;">

    <div class="text-center" style="margin: 20px 0px 20px 0px;">
        <a href="https://www.mynotepaper.com/" target="_blank"><img src="https://i.imgur.com/hHZjfUq.png"></a><br>
        <span class="text-secondary">Add or Remove Input Fields Dynamically using jQuery</span>
    </div>

    <form method="post" action="">
        <div class="row">
            <div class="col-lg-12">
                <div id="inputFormRow">
                    <div class="input-group mb-12">
                        <select class="form-control m-input" id="material" name="material[]" required>
                            <option selected>Pilih Bahan</option>
                            <option>Ayam</option>
                            <option>Ikan</option>
                            <option>Sayur</option>
                        </select>
                        <input type="text" name="test[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                        <select class="form-control m-input" id="material" name="material[]" required>
                            <option selected>Pilih Satuan</option>
                            <option>gram</option>
                            <option>kg</option>
                            <option>cup</option>
                        </select>
                        <input type="text" name="test[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                        <div class="input-group-append">
                            <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>

                <div id="newRow"></div>
                <button id="addRow" type="button" class="btn btn-info">Add Row</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-12">';
        html += '<select class="form-control m-input" id="material" name="material[]" required>';
        html += '<option selected>Pilih Bahan</option>';
        html += '<option>Ayam</option>\n';
        html += '<option>Ikan</option>\n';
        html += '<option>Sayur</option>';
        html += '</select>';
        html += '<input type="text" name="test[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<select class="form-control m-input" id="material" name="material[]" required>';
        html += '<option selected>Pilih Satuan</option>';
        html += '<option>gram</option>';
        html += '<option>kg</option>';
        html += '</select>';
        html += '';
        html += '';
        html += '';
        html += '';
        html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
</body>
</html>
