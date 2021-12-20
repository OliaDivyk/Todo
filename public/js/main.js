/*
 * Lists functions
 */
$(document).on('click', '#addList', function(e) {
    e.preventDefault();
    
    var name = jQuery('#newList #name_list').val();
    var description = jQuery('#newList #list_description').val();

    console.log(name + ' ' + description);
    jQuery.ajax({
        url: '/lists',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'html',
        data: { name, description },
        success: function(){
            location.reload();
        },
        error: function(err){
            var error_text = JSON.parse(err.responseText);
            $('.addListResponse').html('<div class="alert alert-danger" role="alert">' + error_text.status + '</div>');
        } 
    });
});

function removeList(id) {
    jQuery.ajax({
        url: '/lists/' + id,
        method: 'delete',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            location.reload();
        }
    });
}

function editList(id) {
    jQuery.ajax({
        url: '/api/lists/' + id,
        method: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $('#editList form input[name="list-id"]').val(data.id);
            $('#editList form input[name="name"]').val(data.name);
            $('#editList form textarea').val(data.description);
        }
    });
}

function updateList() {

    var id = $('#editList form input[name="list-id"]').val();

    var name = $('#editList form input[name="name"]').val();
    var description = $('#editList form textarea').val();

    jQuery.ajax({
        url: '/lists/' + id,
        method: 'put',
        dataType: 'html',
        data: { name, description },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            location.reload();
        }
    });
}

/*
 * Tasks functions
 */
function addTask() {
    var list_id = jQuery('#list-id').val();
    var name = jQuery('#name').val();
    var description = jQuery('#card_description').val();
    var priority = jQuery('input[name="priority-radio"]:checked').val();

    jQuery.ajax({
        url: '/cards',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'html',
        data: { list_id, name, description, priority },
        success: function(){
            location.reload();
        },
        error: function(err) {
            var error_text = JSON.parse(err.responseText);
            $('.addCardResponse').html('<div class="alert alert-danger" role="alert">' + error_text.status + '</div>');
        }
    });
}

function editTask(id) {
    jQuery.ajax({
        url: '/api/cards/' + id,
        method: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $('#editTask form input[name="list-id"]').val(data.id);
            $('#editTask form input[name="name"]').val(data.name);
            $('#editTask form textarea').val(data.description);

            $("#editTask form input[name=priority-radio][value=" + data.priority + "]").attr('checked', 'checked');
        }
    });
}

function updateTask() {

    var id = $('#editTask form input[name="list-id"]').val();

    var name = $('#editTask form input[name="name"]').val();
    var description = $('#editTask form textarea').val();
    var priority = jQuery('#editTask form input[name="priority-radio"]:checked').val();

    jQuery.ajax({
        url: '/cards/' + id,
        method: 'put',
        dataType: 'html',
        data: { name, description, priority },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            location.reload();
        }
    });
}


/*
 * Admin functions
 */
function changeUserStatus(id, account_status) {
    if (account_status === 1) {
        account_status = 0;
    } else {
        account_status = 1;
    }

    jQuery.ajax({
        url: '/users/' + id,
        method: 'put',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'html',
        data: { account_status },
        success: function(){
            location.reload();
        }
    });
}

function updateUser(id) {
    var firstname = $('#settingsForm input[name="firstname"]').val();
    var lastname = $('#settingsForm input[name="lastname"]').val();
    var email = $('#settingsForm input[name="email"]').val();

    jQuery.ajax({
        url: '/settings/' + id,
        method: 'put',
        dataType: 'html',
        data: { firstname, lastname, email },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            location.reload();
        }
    });
}
