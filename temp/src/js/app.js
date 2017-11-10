(function () {

    "use strict";

    window.$    = require("jquery"),
    window.jQuery = $;

    require("jquery-ui-dist/jquery-ui.js");
    require("retinajs");
    require("Howler");

    $(function () {

      //
      //  Sound

      var sound = new Howl({
        src   : ['audio/rhythm.mp3'],
        loop  : true
      });

      var analyser = Howler.ctx.createAnalyser();

      Howler.masterGain.connect(analyser);

      analyser.connect(Howler.ctx.destination);

      analyser.fftSize = 32;

      var bufferLength = analyser.frequencyBinCount;

      function add(a, b) {
        return a + b;
      }

      // function takeSample() {
      //   var dataArray = new Uint8Array(bufferLength);
      //   analyser.getByteTimeDomainData(dataArray);
      //
      //   var total = dataArray.reduce(add, 0)
      //
      //   $('#counter').text(total);
      //
      //   console.log(dataArray, "buffer length: " + bufferLength, total);
      //
      //   if(total > 2048) {
      //     $('#counter').css({
      //       "color" : "red"
      //     });
      //   } else {
      //     $('#counter').css({
      //       "color" : "yellow"
      //     });
      //   }
      // }
      //
      // takeSample();
      //
      // var repeater = setInterval(function(){
      //   takeSample();
      // }, 1000/60);
      //
      // $(document).on('click', function() {
      //   clearInterval(repeater);
      // })


      // var wait = setTimeout(function(){
      //   $('.mother').addClass('active');
      // }, 3000);

      $('#title').on('click', function () {
        $('.mother').toggleClass('active');
      });

      // Clear listener after first call.
      sound.once('load', function(){
        sound.play();
      });


      $('#upcoming').on('click', function () {
        $(this).toggleClass('active');
        $('.upcoming').toggle();
        $('.bio').hide();
        $('#bio').removeClass('active');
        console.log('click upcoming');
      });

      $('#bio').on('click', function () {
        $(this).toggleClass('active');
        $('.bio').toggle();
        $('.upcoming').hide();
        $('#upcoming').removeClass('active');
        console.log('click bio');
      });

    });

}());
