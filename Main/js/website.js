$('.dropdown-btn').each(function(){
    function toggleDropdown(e)
    {
        var display = $(e).hasClass('active') ? 'block' : 'none';
        var toggle = $(e).attr('data-toggle');
        $(toggle).css('display', display);
    }

    $(this).click(function(){
        $(this).toggleClass('active');
        toggleDropdown(this);
    });

    toggleDropdown(this);
});
