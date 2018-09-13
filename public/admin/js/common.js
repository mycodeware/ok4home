$(function() 
{
 
/* ************************************************************************** */  
/* ************************************************************************** */ 
 
 $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
 


/* ************************************************************************** */  
/* ************************************************************************** */ 
 
});

/* ************************************************************************** */  
/* ************************Generate Slug*************************** */  
/* ************************************************************************** */ 

 	function generate_slug(str) {
	    var $slug = '';
	    var trimmed = $.trim(str);
	    $slug = trimmed.replace(/ /g, '-').
	    replace(/-+/g, '-').
	    replace(/^-|-$/g, '');
	    return $slug.toLowerCase();
	}

/* ************************************************************************** */  
/* ************************Generate Slug*************************** */  
/* ************************************************************************** */ 

	function ConfirmDelete()
	{
	    var x = confirm("Are you sure you want to delete?");
	    if (x)
	        return true;
	    else
	        return false;
	}