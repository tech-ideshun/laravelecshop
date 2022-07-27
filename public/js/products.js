$("#all_button").click(function() {
  console.log('all_button');
  $("#all").css("display", "block");
  $("#selling").css("display", "none");
  $("#stop_selling").css("display", "none");
});
$("#selling_button").click(function() {
  console.log('selling_button');
  $("#all").css("display", "none");
  $("#selling").css("display", "block");
  $("#stop_selling").css("display", "none");
});
$("#stop_selling_button").click(function() {
  console.log('stop_selling_button');
  $("#all").css("display", "none");
  $("#selling").css("display", "none");
  $("#stop_selling").css("display", "block");
});

