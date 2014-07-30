$(document).ready(function(){
  $('#opt_select').change(function(){
    opt_select();
  });
  $('#submitBtn').click(function(){
    saveDoc('opt_in',true);
  });
  $('#resetBtn').click(function(){
    reloadPageElements('opt_in',false);
  });
});

function opt_select(){
  updateForm($('#opt_select').val(),'opt_in',['mongoid','title','status','description']);
  if($('#opt_select').val() != ''){
    reloadFormElement('writer-list', 'opt_in', $('#opt_select').val());
  } else {
    reloadFormElement('writer-list', 'opt_in');
  }
}

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection, ajax){
    $('#'+collection+'_form')[0].reset();
    $('#'+collection+'_form #_id').val('');
    $('#'+collection+'_select').prop('selectedIndex',0);
    reloadFormElement('writer-list', 'opt_in');
    if(ajax){
      reloadFormElement('opt_select_container','opt_in');
      $('#opt_select').change(function(){
        opt_select();
      });
    }
}