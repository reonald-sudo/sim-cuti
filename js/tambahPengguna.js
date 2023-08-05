function autoFillPengguna () {
    $(document).ready(function () {

let nip = $("#nip").val();

    $.ajax({
        url: 'ajax/autoFillPengguna.php',
        method: 'GET',
        data: { nip: nip },
        dataType: 'json', 
        success: function(response) {
            console.log(response);
            $('#nama').val(response.nama);
            $('#golongan').val(response.golongan);
        },
    });
  });
}

