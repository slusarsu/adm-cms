<?php

namespace App\Adm\Enums;

enum PermissionEnum: string
{
    //USER PERMISSIONS
    case CREATE_USER = 'create_user';

    case UPDATE_USER = 'update_user';

    case DELETE_USER = 'delete_user';

    case RESTORE_USER = 'restore_user';

    case FORCE_DELETE_USER = 'force_delete_user';

    //PAGE PERMISSIONS
    case CREATE_PAGE = 'create_page';

    case UPDATE_PAGE = 'update_page';

    case DELETE_PAGE = 'delete_page';

    case RESTORE_PAGE = 'restore_page';

    case FORCE_DELETE_PAGE = 'force_delete_page';

    //POST PERMISSIONS
    case CREATE_POST = 'create_post';

    case UPDATE_POST = 'update_post';

    case UPDATE_ANY_POST = 'update_any_post';

    case DELETE_POST = 'delete_post';

    case RESTORE_POST = 'restore_post';

    case FORCE_DELETE_POST = 'force_delete_post';

    //CATEGORY PERMISSIONS
    case CREATE_CATEGORY = 'create_category';

    case UPDATE_CATEGORY = 'update_category';

    case DELETE_CATEGORY = 'delete_category';

    case RESTORE_CATEGORY = 'restore_category';

    case FORCE_DELETE_CATEGORY = 'force_delete_category';

    //TAG PERMISSIONS
    case CREATE_TAG = 'create_tag';

    case UPDATE_TAG = 'update_tag';

    case DELETE_TAG = 'delete_tag';

    case RESTORE_TAG = 'restore_tag';

    case FORCE_DELETE_TAG = 'force_delete_tag';

    //ROLE PERMISSIONS
    case CREATE_ROLE = 'create_role';

    case UPDATE_ROLE = 'update_role';

    case DELETE_ROLE = 'delete_role';

    case RESTORE_ROLE = 'restore_role';

    case FORCE_DELETE_ROLE = 'force_delete_role';

    //PERMISSION PERMISSIONS
    case CREATE_PERMISSION = 'create_permission';

    case UPDATE_PERMISSION = 'update_permission';

    case DELETE_PERMISSION = 'delete_permission';

    case RESTORE_PERMISSION = 'restore_permission';

    case FORCE_DELETE_PERMISSION = 'force_delete_permission';

    //WIDGET PERMISSIONS
    case SEE_WIDGET = 'see_widget';

    case CREATE_WIDGET = 'create_widget';

    case UPDATE_WIDGET = 'update_widget';

    case DELETE_WIDGET = 'delete_widget';

    case RESTORE_WIDGET = 'restore_widget';

    case FORCE_DELETE_WIDGET = 'force_delete_widget';

    //ADM FORM PERMISSIONS
    case SEE_ADM_FORM = 'see_adm_form';

    case CREATE_ADM_FORM = 'create_adm_form';

    case UPDATE_ADM_FORM = 'update_adm_form';

    case DELETE_ADM_FORM = 'delete_adm_form';

    case RESTORE_ADM_FORM = 'restore_adm_form';

    case FORCE_DELETE_ADM_FORM = 'force_delete_adm_form';

    //MENU FORM PERMISSIONS
    case SEE_MENU = 'see_menu';

    case CREATE_MENU = 'create_menu';

    case UPDATE_MENU = 'update_menu';

    case DELETE_MENU = 'delete_menu';

    case RESTORE_MENU = 'restore_menu';

    case FORCE_DELETE_MENU = 'force_delete_menu';

    //COMMENT FORM PERMISSIONS
    case CREATE_COMMENT = 'create_comment';

    case UPDATE_COMMENT = 'update_comment';

    case DELETE_COMMENT = 'delete_comment';

    //LOGS FORM PERMISSIONS
    case SEE_LOGS = 'see_logs';

    case DELETE_LOGS = 'delete_logs';

    //GALLERY FORM PERMISSIONS
    case SEE_GALLERY = 'see_gallery';

    case CREATE_GALLERY = 'create_gallery';

    case UPDATE_GALLERY = 'update_gallery';

    case DELETE_GALLERY = 'delete_gallery';

    /**
     * @return array
     */
    public static function allValues(): array
    {
        return [
            self::CREATE_USER->value,
            self::UPDATE_USER->value,
            self::DELETE_USER->value,
            self::RESTORE_USER->value,
            self::FORCE_DELETE_USER->value,
            self::CREATE_PAGE->value,
            self::UPDATE_PAGE->value,
            self::DELETE_PAGE->value,
            self::RESTORE_PAGE->value,
            self::FORCE_DELETE_PAGE->value,
            self::CREATE_POST->value,
            self::UPDATE_POST->value,
            self::UPDATE_ANY_POST->value,
            self::DELETE_POST->value,
            self::RESTORE_POST->value,
            self::FORCE_DELETE_POST->value,
            self::CREATE_CATEGORY->value,
            self::UPDATE_CATEGORY->value,
            self::DELETE_CATEGORY->value,
            self::RESTORE_CATEGORY->value,
            self::FORCE_DELETE_CATEGORY->value,
            self::CREATE_TAG->value,
            self::UPDATE_TAG->value,
            self::DELETE_TAG->value,
            self::RESTORE_TAG->value,
            self::FORCE_DELETE_TAG->value,
            self::CREATE_ROLE->value,
            self::UPDATE_ROLE->value,
            self::DELETE_ROLE->value,
            self::RESTORE_ROLE->value,
            self::FORCE_DELETE_ROLE->value,
            self::CREATE_PERMISSION->value,
            self::UPDATE_PERMISSION->value,
            self::DELETE_PERMISSION->value,
            self::RESTORE_PERMISSION->value,
            self::FORCE_DELETE_PERMISSION->value,
            self::SEE_WIDGET->value,
            self::CREATE_WIDGET->value,
            self::UPDATE_WIDGET->value,
            self::DELETE_WIDGET->value,
            self::RESTORE_WIDGET->value,
            self::FORCE_DELETE_WIDGET->value,
            self::SEE_ADM_FORM->value,
            self::CREATE_ADM_FORM->value,
            self::UPDATE_ADM_FORM->value,
            self::DELETE_ADM_FORM->value,
            self::RESTORE_ADM_FORM->value,
            self::FORCE_DELETE_ADM_FORM->value,
            self::SEE_MENU->value,
            self::CREATE_MENU->value,
            self::UPDATE_MENU->value,
            self::DELETE_MENU->value,
            self::RESTORE_MENU->value,
            self::FORCE_DELETE_MENU->value,
            self::CREATE_COMMENT->value,
            self::UPDATE_COMMENT->value,
            self::DELETE_COMMENT->value,
            self::SEE_LOGS->value,
            self::DELETE_LOGS->value,
            self::SEE_GALLERY->value,
            self::CREATE_GALLERY->value,
            self::UPDATE_GALLERY->value,
            self::DELETE_GALLERY->value,
        ];
    }

    /**
     * @return array
     */
    public static function userValues(): array
    {
        return [
            self::CREATE_USER->value,
            self::UPDATE_USER->value,
            self::DELETE_USER->value,
            self::RESTORE_USER->value,
            self::FORCE_DELETE_USER->value,
        ];
    }

    /**
     * @return array
     */
    public static function pageValues(): array
    {
        return [
            self::CREATE_PAGE->value,
            self::UPDATE_PAGE->value,
            self::DELETE_PAGE->value,
            self::RESTORE_PAGE->value,
            self::FORCE_DELETE_PAGE->value,
        ];
    }

    /**
     * @return array
     */
    public static function postValues(): array
    {
        return [
            self::CREATE_POST->value,
            self::UPDATE_POST->value,
            self::DELETE_POST->value,
            self::RESTORE_POST->value,
            self::FORCE_DELETE_POST->value,
        ];
    }

     /**
     * @return array
     */
    public static function categoryValues(): array
    {
        return [
            self::CREATE_CATEGORY->value,
            self::UPDATE_CATEGORY->value,
            self::DELETE_CATEGORY->value,
            self::RESTORE_CATEGORY->value,
            self::FORCE_DELETE_CATEGORY->value,
        ];
    }

    /**
     * @return array
     */
    public static function tagValues(): array
    {
        return [
            self::CREATE_TAG->value,
            self::UPDATE_TAG->value,
            self::DELETE_TAG->value,
            self::RESTORE_TAG->value,
            self::FORCE_DELETE_TAG->value,
        ];
    }

    /**
     * @return array
     */
    public static function roleValues(): array
    {
        return [
            self::CREATE_ROLE->value,
            self::UPDATE_ROLE->value,
            self::DELETE_ROLE->value,
            self::RESTORE_ROLE->value,
            self::FORCE_DELETE_ROLE->value,
        ];
    }

    /**
     * @return array
     */
    public static function permissionValues(): array
    {
        return [
            self::CREATE_PERMISSION->value,
            self::UPDATE_PERMISSION->value,
            self::DELETE_PERMISSION->value,
            self::RESTORE_PERMISSION->value,
            self::FORCE_DELETE_PERMISSION->value,
        ];
    }



}
