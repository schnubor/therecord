$.getReleases = (username) ->
    $request = $.ajax
        url: 'https://api.discogs.com/users/'+username+'/collection/folders/0/releases'
        type: 'GET'
        error: (x,status,error) ->
            console.log status
            console.log error
        success: (response) ->
            #console.log response
            $('.js-importResults').html('<p class="placeholder">Found '+response.releases.length+' records in your Discogs collection.</p>')
            $.each response.releases, (index) ->
                $('.js-importTable').find('tbody').append('<tr><td>'+response.releases[index].id+'</td><td>'+response.releases[index].basic_information.artists[0].name+'</td><td>'+response.releases[index].basic_information.title+'</td></tr>');
            $('.js-importTable').fadeIn()
