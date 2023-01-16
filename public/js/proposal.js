$(function(){
  //Add active class
  $('#proposal').addClass('active');

  $('#table').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "autoWidth": false,
  });
});

