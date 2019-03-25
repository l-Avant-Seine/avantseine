

(function() {
   tinymce.create('tinymce.plugins.accordeon_plugin', {
      init : function(ed, url) {
         ed.addButton('accordeon', {
            title : 'Accordéon',
            image : url+'/select-arrow.png',
            onclick : function() {
               var title = prompt("Titre de l'accordéon", "ici");

               if (title != null && title != ''){
                 ed.execCommand('mceInsertContent', false, '[accordeon titre="'+title+'"][/accordeon]');
               }
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Shortcode Accordéon",
            author : 'Thomas',
            infourl : '',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('accordeon', tinymce.plugins.accordeon_plugin);
})();
