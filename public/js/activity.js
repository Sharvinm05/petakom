//navbar active 
$(function(){
  //Add active class
  $('#activity').addClass('active');
});

//pass id to modal in view
function openModal(activityId) {
  $("#exampleModalCenter-" + activityId).modal("show");
}

//pass id for detail page
function viewData(id) {
  window.location = '/activity/viewDetails/' + id;
}

//pass id for registration page
function regData(id) {
  window.location = '/activity/registerActivity/' + id;
}



