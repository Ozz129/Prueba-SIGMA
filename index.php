<!DOCTYPE html>
<html lang="en">

<head>
  <title>SIGMA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="myStyle.css">
</head>

<body onload="getInfoSelect()">

  <div class="text-center" style="padding-top: 4%;">
    <img src="assets/img/sigma-logo.png" alt="">
  </div>

  <div class="title text-center">
    <h3>Prueba de desarrollo Sigma</h3>
  </div>

  <div class="text-center mensaje">
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
      Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
      when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <img class="side_img" src="assets/img/sigma-image.png" alt="">
      </div>
      <div class="col-sm-6">
        <div class="row form">
          <div class="col-sm-12">
            <label for="">Departamento*</label>
            <div id="select_depto">
              <select name="" id="" class="outlinenone">
                <option value="" disbled>Selecciona</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12">
            <label for="">Ciudad*</label>
            <div id="select_ciudad">
              <select name="" id="" class="outlinenone">
                <option value="" disbled>Selecciona</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12">
            <label for="">Nombre*</label>
            <input type="text" class="outlinenone" id="name" name="name" onblur="caracteresNombre()">
            <span id="err_name"></span>
          </div>
          <div class="col-sm-12">
            <label for="">Correo*</label>
            <input type="text" class="outlinenone" placeholder="Pepito de Jesus" id="email" id="email" onblur="caracteresCorreoValido()">
            <span id="err_email"></span>
          </div>
          <div class="col-sm-12" style="margin-top: 5%; text-align: center;">

            <a class="btn_enviar" onclick="save()">ENVIAR</a>
          </div>

        </div>
      </div>
    </div>
  </div>

</body>
<script>
  var data
  var getInfoSelect = function() {
    $.ajax({
      type: "GET",
      url: 'control/get_info.php',
      success: function(res) {
        data = JSON.parse(res)
        console.log(data)
        var select = '<select name="depto" id="depto" class="outlinenone" onchange="setCity()">'
        for (var depto in data) {
          select = select + '<option value="' + depto + '">' + depto + '</option>'
        }
        select = select + '</select>';
        $('#select_depto').html(select)
      }
    });
  }

  var setCity = function() {
    var depto = $('#depto').val();
    var cities = data[depto]

    var select = '<select name="ciudad" id="ciudad" class="outlinenone" onchange="setCity()">'

    for (var i = 0; i < cities.length; i++) {
      select = select + '<option value="' + cities[i] + '">' + cities[i] + '</option>'
    }
    select = select + '</select>';
    $('#select_ciudad').html(select)
  }



  var save = function() {
    var name = $('#name').val();
    var email = $('#email').val();
    var city = $('#ciudad').val();
    var department = $('#depto').val();

    $.ajax({
      type: "POST",
      url: 'control/insert.php',
      data: {"name": name, "email": email, "city": city, "department": department},
      success: function(res) {
        swal("Tu información ha sido recibida satisfactoriamente", "", "success");
      }
    });

  }

  function caracteresCorreoValido() {
    var email = $('#email').val()
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

    if (caract.test(email) == false) {
      $('#email').css('border', 'red solid 1px')
      $('#err_email').css('color', 'red')
      $('#err_email').html('Ingresa un correo electrónico correcto')
    } else {
      $('#email').css('border', '#E1E1E1 solid 1px')
      $('#err_email').html('')
    }
  }

  function caracteresNombre() {
    var regName = /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/;
    var nombre = $('#name').val()
    console.log(nombre)
    if (!regName.test(nombre)) {
      $('#name').css('border', 'red solid 1px')
      $('#err_name').css('color', 'red')
      $('#err_name').html('Ingresa un nombre correcto')
    } else {
      if (nombre.length > 50) {
        $('#name').css('border', 'red solid 1px')
        $('#err_name').css('color', 'red')
        $('#err_name').html('Ingresa un nombre correcto')
      } else {
        $('#name').css('border', '#E1E1E1 solid 1px')
        $('#err_name').html('')
      }
    }
  }
</script>

</html>