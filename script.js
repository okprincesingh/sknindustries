window.addEventListener("load", (event) => {

    var Recentblog = "all";
    var latestblog = "all";
    var showAllBlog = "all";
    
    $.ajax({
        url: "view/view-data.php",
        type: "POST",
        data: { Recentblog: Recentblog },
        success: function (data, status) {
            // console.log(data);
            $('#recentblog').html(data);
        }
    })
    
    $.ajax({
        url: "view/view-data.php",
        type: "POST",
        data: { latestblog: latestblog },
        success: function (data, status) {
            // console.log(data);
            $('#latestblog').html(data);
        }
    })

    $.ajax({
        url: "view/view-data.php",
        type: "POST",
        data: { showAllBlog: showAllBlog },
        success: function (data, status) {
            // console.log(data);
            $('#displayAllBlog').html(data);
        }
    })
});

$(document).on("click", "#blog_cat_id", function () {
    const id = $(this).data("id");
    // alert(id);
      $('.category-name').on('click', function() {
      $('.category-name').removeClass('active');
      $(this).addClass('active');
    });
    
    $.ajax({
        url: "view/view-data.php",
        type: "POST",
        data: { blog_catId: id },
        success: (data) => {
            console.log(data);
            $("#display-blogs").html(data);
        }
    })
})

function showCat(){
    $('#displayAllBlog').hide();
    $('#display-blogs').show();
}

