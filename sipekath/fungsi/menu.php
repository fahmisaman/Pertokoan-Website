<?php
include 'conn.php';
class menu {
	function load_menu_by($level,$menu){
		$result=mysql_query("SELECT id, title, url, parent_id, icon FROM $menu WHERE level = '$level' ORDER BY parent_id, menu_order, title");
	    // Create a multidimensional array to conatin a list of items and parents
	    $menu = array(
	        'items' => array(),
	        'parents' => array()
	    );
	    // Builds the array lists with data from the menu table
	    while ($items = mysql_fetch_assoc($result))
	    {
	        // Creates entry into items array with current menu item id ie. $menu['items'][1]
	        $menu['items'][$items['id']] = $items;
	        // Creates entry into parents array. Parents array contains a list of all items with children
	        $menu['parents'][$items['parent_id']][] = $items['id'];
	    }
	    return $menu;
	}

	function buildMenu($parent, $menu)
    {
       $html = "";
       if (isset($menu['parents'][$parent]))
       {
           foreach ($menu['parents'][$parent] as $itemId)
           {
              if(!isset($menu['parents'][$itemId]))
              {
                 $html .= "<li><a class='treeview' href='".$menu['items'][$itemId]['url']."'><i class='fa ".$menu['items'][$itemId]['icon']." fa-fw'></i> <span>".$menu['items'][$itemId]['title']."</a></span></li>";
              }
              if(isset($menu['parents'][$itemId]))
              {
                 $html .= "<li><a class='treeview' href='".$menu['items'][$itemId]['url']."'><i class='fa ".$menu['items'][$itemId]['icon']." fa-fw'></i><span> ".$menu['items'][$itemId]['title']."</span><i class='fa fa-angle-left pull-right'></i></a>";
                 $html .= "<ul class='treeview-menu'>";
                 $html .= $this->buildMenu($itemId, $menu);
                 $html .= "</ul>";
                 $html .= "</li>";
              }
           }
           
       }
       return $html;
   }

}