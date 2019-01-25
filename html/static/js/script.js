$.fn.extend({
  treeview: function() {
    return this.each(function() {
      // Initialize the top levels;
      var tree = $(this);
      
      tree.addClass('treeview-tree');
      tree.find('li').each(function() {
        var stick = $(this);
      });
      tree.find('li').has("ul").each(function () {
        var branch = $(this); //li with children ul
        
        branch.prepend("<i class='tree-indicator glyphicon glyphicon-chevron-right'></i>");
        branch.addClass('tree-branch');
        branch.on('click', function (e) {
          if (this == e.target) {
            var icon = $(this).children('i:first');
            
            icon.toggleClass("glyphicon-chevron-down glyphicon-chevron-right");
            $(this).children().children().toggle();
          }
        })
        branch.children().children().toggle();
        
        /**
         *  The following snippet of code enables the treeview to
         *  function when a button, indicator or anchor is clicked.
         *
         *  It also prevents the default function of an anchor and
         *  a button from firing.
         */
         branch.children('.tree-indicator, button, a').click(function(e) {
          branch.click();
          
          e.preventDefault();
        });
       });
    });
  }
});
/*-------------------------Menu con ajax en CPANEL-------------------------*/
$('#cpmain').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpmain.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cppubact').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cppubact.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cppubbor').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cppubbor.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cppubcer').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cppubcer.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cppubpre').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cppubpre.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cppubnue').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cppubnue.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpcomact').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpcomact.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpcomsin').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpcomsin.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpcomcer').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpcomcer.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpcompre').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpcompre.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpperact').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpperact.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cppercer').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cppercer.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cppersol').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cppersol.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpfacpen').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpfacpen.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpfacpag').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpfacpag.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpdenact').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpdenact.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpdencer').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpdencer.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpconper').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpconper.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpconcon').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpconcon.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
  $('#cpnavtoggle').click();
});
$('#cpconcom').click(function () {
  // Mostramos gif de carga
  $('#cpsection').html('<img src="../static/loading.gif">');
  $.ajax({
    type: "GET",
    data: $(this).serialize(),
    dataType: "json",
    url: "cpconcom.php",
    success: function(html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    },
    error: function (html) {
      //chit consola (ver que te devuelve)
      //console.log(html);
      $('#cpsection').html(html.responseText);
    }
  });
});

$("#radio1").click(function(){
    $("#BotCompra").append("<button id='prueba2' class='btn btn-success btn-product'><i class='fa fa-shopping-cart' aria-hidden='true'></i> Comprar</button>");
    $("#BotPermuta div").remove();
  });
  $("#radio2").click(function(){
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "permuta.php",
      success: function(html) {
        $('#BotPermuta').html(html.responseText);
      },
      error: function (html) {
        $('#BotPermuta').html(html.responseText);
      }
    });
    $("#BotCompra .btn").remove();
  });

/*-------------------------FIN MENU CPANEL-------------------------*/
/* Chit para dejar solo los Padre  */
$(window).on('load', function () {
  $('.treeview').each(function () {
    var tree = $(this);
    tree.treeview();
  })
});
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
$(document).ready(function(){
          $('[data-toggle="popover"]').popover({ html : true });
        });
/* AJAX PRUEBA PARA CONTROL DE USUARIO 
$('#regusername').keyup(function () {
  var usuario = $('#regusername').val();

  alert(usuario);
  $('#regusernameerror').removeClass ('hidden');
});
*/