<?php
// Create a select field to select multiple organizers

function field_organizers($post) {
//List of participants already saved
$organizers = get_post_meta($post->ID, 'organizers', true);
if (empty($organizers)) {
  $organizers = array();
} else {
  $organizers = explode(",", $organizers);
}

wp_nonce_field("save_pbf_post", "field_organizers");

//mon widget
echo '<div class="ui-widget">';
echo '<ul id="organizers-selected">';
// j'y affiche toutes les entrées déjà sauvegardées dans la meta</ul>
if( ! empty( $organizers) )
  foreach( $organizers as $c )
    echo '<li data-id="' . $c . '"><span class="erase">x</span> ' . get_the_title($c) . '</li>';
echo '</ul>';
echo "<p>Utiliser le champ ci-dessous pour rechercher et ajouter des organisateurs.</p>";
echo '<label for="nom"></label><input id="title_organizer" name="title_organizer" " type="text" placeholder="Rechercher un organisateur."/>';

// mon champ caché, que je mettrai à jour et sauvegarderai
// il contient déjà les valeurs de la meta
echo'<input id="organizers" type="hidden" name="organizers" value="'. implode(',',$organizers) .'" required/>';

//fin du widget
echo '</div>';
echo '<div style="clear:both;"></div>'
// script autocomplete
?>
<script type="text/javascript">
//no-conflict
jQuery(function($) {

// un tableau avec tous les conférenciers que l'on peut sélectionner
var availableTags = [
<?php $all_organizers = get_posts('post_type=participant&posts_per_page=-1');
foreach($all_organizers as $evt){
  if ($evt != $all_organizers[0]) echo ",";
  echo '{value:"'.$evt->ID.'",label:"'.get_the_title($evt).'"}'."\n";
}?>
];


$( "#title_organizer" ).autocomplete({
  // je mets le tableau précédemment crée en source
  source: availableTags,
  // lorsqe l'on sélectionne un élément
  select: function(organizer,ui){
    //je crée un nouveauv<ul><li>
    var li = '<li data-id="' + ui.item.value + '"><span class="erase">x</span> ' + ui.item.label + '</li>';
    //je fais un tableaux des conférencier déjà ajouté
    var organizers = new Array();
    organizers =($('#organizers').val()!='') ? $('#organizers').val().split(',') : [];
    // si il est déjà dans la liste, j'en tiens pas compte
    if($.inArray(ui.item.value, organizers)!="-1"){
      $(this).val('');
    }else{
      //sinon je l'ajoute à la liste
      organizers.push(ui.item.value);
      //je pousse cette liste dans le champ caché
      $('#organizers').val(organizers);
      //et j'ajoute la nouvelle entrée dans le <ul>
      $( "#organizers-selected" ).append(li);

      listenerremove();

      $(this).val('');
    }
    //juste pour que la sélection d'un élément ne remplisse pas le input (comportement normal)
    return false;
  }
});

//function qui me sert à supprimer l'ID d'un conférencier dans #conf_presents
function removeByElement(arrayName,arrayElement){
  for(var i=0; i < arrayName.length; i++) {
    if(arrayName[i]==arrayElement)
    arrayName.splice(i,1);
  }
}

//évènement de suppression de conférencier
function listenerremove(){
  $( "#organizers-selected" ).find('li .erase').on('click',function(){
    // suppression élément
    var $elem = $(this).parent('li'); //je cible l'élément à supprimer
    //je construit un talbeau avec les conférencier actuellement liés
    var organizers_selected = new Array();
    organizers_selected =$('#organizers').val().split(',');
    //je récupère l'ID à retirer
    var dataval = $elem.attr('data-id');
    // je supprime l'ID du tableau
    removeByElement(organizers_selected,dataval);
    //je supprime le conférencier dans la liste
    $elem.remove();
    //je supprime son ID dans le champ caché
    $('#organizers').val(organizers_selected.join(","));
  });
}

//je lance la fonction
listenerremove();

});

</script>
<style>
.erase{
    background:#999;
    color:#FFF;
    padding:0 4px;
    -moz-border-radius:10px;
    -webkit-border-radius:10px;
    -o-border-radius:10px;
    border-radius:10px;
}
.erase:hover{
    background:#F20;
    cursor:pointer;
}

#organizers-selected {
  display: block;
  width: 50%;
  float: right;
}

#organizers-selected li {
  border: solid 1px #999;
  padding: 5px;
  background-color: #f1f1f1;
}

</style>
<?php
}
?>
