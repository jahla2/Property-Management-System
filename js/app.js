$(document).ready(function(){

  $('#selectAllBoxes').click(function(event){

    if(this.checked) {

      $('.checkBoxes').each(function(){

        this.checked = true;

      });

    } else {
      $('.checkBoxes').each(function(){

        this.checked = false;

      });
    }

  });


});

$(document).ready(function(){
  $("#confirm").click(function(){
    Swal.fire({
      title: 'Data Deleted',
      icon: 'success'
    })
  });
});

//Data Tables
$(document).ready(function(){
  $('#table').DataTable({
    processing: true,
    serverside: true,
    destroy: true,
    retrieve: true,
    ajax: "Viewquery.php",//Route File From Query send to database
    columns: [
      {
        data: 'id',
        name: 'id',
      },
      {
        data: 'serial_no',
        name: 'serial_no',
      }, 
      {
        data: 'property_no',
        name: 'property_no',
      },
      {
        data: 'location',
        name: 'location',
      },
      {
        data: 'date',
        name: 'date',
      },
      {
        data: 'cost',
        name: 'cost',
      },
      {
        data: 'prescription',
        name: 'prescription',
      },
    ]
  });
});