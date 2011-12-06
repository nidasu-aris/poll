<?php
/**
 * Routes
 *
 * poll_routes.php will be loaded in main app/config/routes.php file.
 */
    Croogo::hookRoutes('Poll');
/**
 * Behavior
 *
 * This plugin's Poll behavior will be attached whenever Node model is loaded.
 */
    //Croogo::hookBehavior('Node', 'Poll.Poll', array());
/**
 * Component
 *
 * This plugin's Poll component will be loaded in ALL controllers.
 */
    Croogo::hookComponent('*', 'Poll.Polls');
/**
 * Helper
 *
 * This plugin's Poll helper will be loaded via NodesController.
 */
    //Croogo::hookHelper('Nodes', 'Poll.Poll');
/**
 * Admin menu (navigation)
 *
 * This plugin's admin_menu element will be rendered in admin panel under Extensions menu.
 */
    Croogo::hookAdminMenu('Poll');
/**
 * Admin row action
 *
 * When browsing the content list in admin panel (Content > List),
 * an extra link called 'Poll' will be placed under 'Actions' column.
 */
    //Croogo::hookAdminRowAction('Nodes/admin_index', 'Poll', 'plugin:poll/controller:poll/action:index/:id');
/**
 * Admin tab
 *
 * When adding/editing Content (Nodes),
 * an extra tab with title 'Poll' will be shown with markup generated from the plugin's admin_tab_node element.
 *
 * Useful for adding form extra form fields if necessary.
 */
    //Croogo::hookAdminTab('Nodes/admin_add', 'Poll', 'poll.admin_tab_node');
    //Croogo::hookAdminTab('Nodes/admin_edit', 'Poll', 'poll.admin_tab_node');
?>