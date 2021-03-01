(function ($) {
  let contentDataCache = [];

  /**
   * Display popup on user id,name or username click.
   */
  $(".inpsyde-users a").on("click", function (event) {
    $('.inpsyde-popup-spinner').removeClass('hide');
    $(".inpsyde-popup-mask, .inpsyde-popup-wrapper").addClass("active");

    // Get user id from parent td
    const userId = $(event.target).parents('tr').attr('data-userId')
    if (contentDataCache[userId]){
      $('.inpsyde-popup-spinner').addClass('hide');
      $('.inpsyde-popup-content').html(contentDataCache[userId]);
    } else {
      getUserDetails(userId);
    }
  });

  $(".inpsyde-popup-modal-close, .inpsyde-popup-mask").on("click", function () {
    closePopup();
  });

  $(document).keyup(function (e) {
    // Close popup if user click ESC
    if (e.keyCode == 27) {
      closePopup();
    }
  });

  /**
   * Sent a AJAX request to backend to get user details
   */
  function getUserDetails (userId) {
    $.ajax({
      url: inpsydeUsers.ajaxUrl,
      type: 'post',
      data: {
        action: 'getUserDetail',
        userId: userId,
        nonce: inpsydeUsers.nonce
      },
      success: function (response) {
        $('.inpsyde-popup-spinner').addClass('hide');
        $('.inpsyde-popup-content').html(response);
        contentDataCache[userId] = response;
      },
      error: function (xhr, ajaxOptions, thrownError) {
        $('.inpsyde-popup-spinner').addClass('hide');
        if (xhr.status === 500) {
          $('.inpsyde-popup-content').html(xhr.status + ': ' + thrownError + '<p>There are some problems with request. Please try again later.</p>');
        }
      }
    });
  }

  /**
   * Close the user detail popup
   */
  function closePopup () {
    $('.inpsyde-popup-spinner').addClass('hide');
    $(".inpsyde-popup-mask, .inpsyde-popup-wrapper").removeClass("active");
    $('.inpsyde-popup-content').html('');
  }
})(jQuery);