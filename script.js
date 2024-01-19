$(document).ready(function() {
    // Function to submit the vote using AJAX
    window.submitVote = function() {
      var vote = $("input[name='vote']:checked").val(); 
      $.ajax({
        type: "POST",
        url: "poll.php",
        data: { vote: vote },
        dataType: "json",
        success: function(response) {
            // Check if there is an error message
            if (response.error) {
              // Handle the error (display it, etc.)
              $('.error').text(response.error);
            } 
                // Calculate and update poll results as percentages
                var totalVotes = response.pollResults.reduce(function(sum, option) {
                  return sum + option.count;
                }, 0);
                
             
                if(response.pollResults.length == 1){
                  if(response.pollResults[0].vote_option == 'option1'){
                    $('#option2').attr("style","width: 0%");
                  $('#option2').text('0%');
                  }else{
                    $('#option1').attr("style","width: 0%");
                    $('#option1').text('0%');
                  }
                }
                // $("#pollResults").html("");
                var i = 1;
                response.pollResults.forEach(function(option) {
                  var percentage = (option.count / totalVotes) * 100;
                  $(`#${option.vote_option}`).attr("style",`width: ${percentage.toFixed(2)}%`);
                  // $("#option_2").attr("style",`width: ${percentage.toFixed(2)}%`);
                  $(`#${option.vote_option}`).text(`${percentage.toFixed(2)}%`);
                  i++;
                  // $("#option_2").text(`${percentage.toFixed(2)}%`);
                  // $("#pollResults").append(
                  //   option.vote_option + " Votes: " + option.count +
                  //   " (" + percentage.toFixed(2) + "%)" + "<br>"
                  // );
                });
             
          },
        error: function(error) {
          console.error("Error submitting vote:", error);
        }
      });
    };
    
    function updateCheckBox(){
      $.ajax({
        type: "POST",
        url: "updatecheck.php",
        success: function(data) {
          $("input[name='vote'][value='" + data + "']").prop("checked", true);
        }
      });
    }
    updateCheckBox();
    // Load initial poll results on page load
    window.submitVote();
  });
  