<?php
 // Register Custom Post Type: Participants
 function register_type_participant() {

 	$labels = array(
 		'name'                  => _x( 'Participants', 'Post Type General Name', 'pbf' ),
 		'singular_name'         => _x( 'Participant', 'Post Type Singular Name', 'pbf' ),
 		'menu_name'             => __( 'Participants', 'pbf' ),
 		'name_admin_bar'        => __( 'Participants', 'pbf' ),
 		'archives'              => __( 'Participants', 'pbf' ),
 		'attributes'            => __( 'Item Attributes', 'pbf' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbf' ),
 		'all_items'             => __( 'Tous les participants', 'pbf' ),
 		'add_new_item'          => __( 'Ajouter un Participant', 'pbf' ),
 		'add_new'               => __( 'Ajouter un Participant', 'pbf' ),
 		'new_item'              => __( 'Nouveau Participant', 'pbf' ),
 		'edit_item'             => __( 'Edit Item', 'pbf' ),
 		'update_item'           => __( 'Update Item', 'pbf' ),
 		'view_item'             => __( 'View Item', 'pbf' ),
 		'view_items'            => __( 'View Items', 'pbf' ),
 		'search_items'          => __( 'Search Item', 'pbf' ),
 		'not_found'             => __( 'Not found', 'pbf' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'pbf' ),
 		'featured_image'        => __( 'Featured Image', 'pbf' ),
 		'set_featured_image'    => __( 'Set featured image', 'pbf' ),
 		'remove_featured_image' => __( 'Remove featured image', 'pbf' ),
 		'use_featured_image'    => __( 'Use as featured image', 'pbf' ),
 		'insert_into_item'      => __( 'Insert into item', 'pbf' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'pbf' ),
 		'items_list'            => __( 'Items list', 'pbf' ),
 		'items_list_navigation' => __( 'Items list navigation', 'pbf' ),
 		'filter_items_list'     => __( 'Filter items list', 'pbf' ),
 	);
 	$args = array(
 		'label'                 => __( 'Participant', 'pbf' ),
 		'description'           => __( 'Organisateur des évènements Paris Beer Festival', 'pbf' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title', 'editor', 'thumbnail' ),
 		'hierarchical'          => false,
 		'public'                => true,
 		'show_ui'               => true,
 		'show_in_menu'          => true,
 		'menu_position'         => 5,
 		'show_in_admin_bar'     => true,
 		'show_in_nav_menus'     => true,
 		'can_export'            => true,
 		'has_archive'           => true,
 		'exclude_from_search'   => false,
 		'publicly_queryable'    => true,
 		'capability_type'       => 'page',
 	);
 	register_post_type( 'participant', $args );

 }
 add_action( 'init', 'register_type_participant', 0 );

 add_action('add_meta_boxes','meta_box_participant');
 function meta_box_participant(){
   add_meta_box('meta_box_participant', 'Evènements du participant', 'meta_box_participant_content', 'participant', 'normal', 'default');
 }

function meta_box_participant_content($post) {
//je récupère la meta potentiellement sauvegardée
$events = get_post_meta($post->ID, 'events', false);

//je créer un nonce
wp_nonce_field("save_pbf_post", "pbf_post_form_nonce");

//mon widget
echo '<div class="ui-widget">';
echo "<p>Utiliser le champ ci-dessous pour rechercher et ajouter un évènement. Seuls trois évènements peuvent être associés à un participant.</p>";
echo '<label for="nom"></label><input id="title_event" type="text" placeholder="Rechercher un évènement"/>';
echo '<ul id="events-selected">';
// j'y affiche toutes les entrées déjà sauvegardées dans la meta</ul>
if( ! empty( $events) )
  foreach( $events as $c )
    echo '<li data-id="' . $c . '"><span class="erase">x</span> ' . get_the_title($c) . '</li>';
echo '</ul>';

// mon champ caché, que je mettrai à jour et sauvegarderai
// il contient déjà les valeurs de la meta
echo'<input id="events" type="hidden" name="events" value="'. implode(',',$events) .'" />';

//fin du widget
echo '</div>';
// script autocomplete
?>
<script type="text/javascript">
//no-conflict
jQuery(function($) {

// un tableau avec tous les conférenciers que l'on peut sélectionner
var availableTags = [
<?php $all_events = get_posts('post_type=event&posts_per_page=-1');
foreach($all_events as $evt){
  if ($evt != $all_events[0]) echo ",";
  echo '{value:"'.$evt->ID.'",label:"'.get_the_title($evt).'"}'."\n";
}?>
];


$( "#title_event" ).autocomplete({
  // je mets le tableau précédemment crée en source
  source: availableTags,
  // lorsqe l'on sélectionne un élément
  select: function(event,ui){
    //je crée un nouveauv<ul><li>
    var li = '<li data-id="' + ui.item.value + '"><span class="erase">x</span> ' + ui.item.label + '</li>';
    //je fais un tableaux des conférencier déjà ajouté
    var events = new Array();
    events =($('#events').val()!='') ? $('#events').val().split(',') : [];
    // si il est déjà dans la liste, j'en tiens pas compte
    if($.inArray(ui.item.value, events)!="-1"){
      $(this).val('');
    }else{
      //sinon je l'ajoute à la liste
      events.push(ui.item.value);
      //je pousse cette liste dans le champ caché
      $('#events').val(events);
      //et j'ajoute la nouvelle entrée dans le <ul>
      $( "#events-selected" ).append(li);

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
  $( "#events-selected" ).find('li .erase').on('click',function(){
    // suppression élément
    var $elem = $(this).parent('li'); //je cible l'élément à supprimer
    //je construit un talbeau avec les conférencier actuellement liés
    var events_selected = new Array();
    events_selected =$('#events').val().split(',');
    //je récupère l'ID à retirer
    var dataval = $elem.attr('data-id');
    // je supprime l'ID du tableau
    removeByElement(events_selected,dataval);
    //je supprime le conférencier dans la liste
    $elem.remove();
    //je supprime son ID dans le champ caché
    $('#events').val(events_selected.join(","));
  });
}

//je lance la fonction
listenerremove();

});

</script>
<style>
.erase{
    background:#2e2e2e;
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
</style>
<?php
}
