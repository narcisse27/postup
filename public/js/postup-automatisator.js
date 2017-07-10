CKEDITOR.plugins.add( 'postupAutomatisator',
    {

      requires : ['richcombo'], //, 'styles' ],
      init : function( editor )
      {

        var config = editor.config,
          lang = editor.lang.format;


        // Gets the list of tags from the settings.
        var tags = []; //new Array();
        //this.add('value', 'drop_text', 'drop_label');
        tags[0]=['<span  class="postup-appel-span" title="Madame, Monsieur ou Madame ou Monsieur" contenteditable="false" style="background-color:#fe0364; border-radius:5px; color:white">&nbspAppel&nbsp</span>', "Madame, Monsieur", "Madame, Monsieur ou Madame ou Monsieur"];
        tags[1]=['<span  class="postup-corporate-span" title="Nom automatique de l\'entreprise choisie" contenteditable="false" style="background-color:#fe0364; border-radius:5px; color:white">&nbspNom entreprise&nbsp</span>', "Nom d'entreprise", "Nom d'entreprise"];

        // Create style objects for all defined styles.

        editor.ui.addRichCombo( 'PostupAutomatisator',
          {
            label : "variables",
            title :"variables",
            voiceLabel : "variables",
            className : 'cke_format',
            attributes: 'contendeditable',
            multiSelect : false,

            panel :
            {
              css : [ config.contentsCss, CKEDITOR.getUrl( editor.skinPath + 'editor.css' ) ],
              voiceLabel : lang.panelVoiceLabel
            },

            init : function()
            {
              //this.startGroup( "Tokens" );
              //this.add('value', 'drop_text', 'drop_label');
              for (var this_tag in tags){
                this.add(tags[this_tag][0], tags[this_tag][1], tags[this_tag][2]);
              }
            },

            onClick : function( value )
            {
              editor.focus();
              editor.fire( 'saveSnapshot' );
              editor.insertHtml(value);
              editor.fire( 'saveSnapshot' );
            }
          });
        config.extraAllowedContent = 'span;ul;li;table;td;style;*[id];*(*);*{*}';
      }

    } );
