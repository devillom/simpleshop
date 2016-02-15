<?php
/**
 * Created by PhpStorm.
 * User: uitlab
 * Date: 07.02.2016
 * Time: 9:13
 */


/*
 *
 */
function renderSortableNode($node)
{
    if (!$node->hasParent()) {
        return '
         <li class="uk-nestable-item"  data-id="' . $node->id . '" ">
            <div class="uk-nestable-panel">
            <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>
               ' . $node->name . '
            </div>
        </li>';

    } else {
        $html = '<li class="uk-nestable-item uk-parent" data-id="' . $node->id . '">
                    <div class="uk-nestable-panel">
                        <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>
                       ' . $node->name.''.renderForm($node). '
                    </div>';

        $html .= '<ul class="uk-nestable-list">';

        foreach ($node->children as $child)
            $html .= renderSortableNode($child);

        $html .= '</ul>';

        $html .= '</li>';
    }

    return $html;
}


function renderMenu($node)
{
    if (!$node->hasParent() || !$node->children()->count()) {
        return '
         <li>
            <a href="">'.$node->name.'</a>
         </li>';

    } else {
        $html = '<li >
                    <a href="#">'.$node->name.'<i class="carret"></i></a>';
        $html .= '<ul >';

        foreach ($node->children as $child)
            $html .= renderMenu($child);

        $html .= '</ul>';

        $html .= '</li>';
    }

    return $html;
}


function renderForm($node)
{
    $html = Form::open(['route' => ['manager.shop.category.destroy', $node->id], 'method' => 'delete', 'class' => 'confirm uk-float-right']) .
        "<a href=\"".route('manager.shop.category.edit', ['category' => $node->id])."\"
                       class=\"uk-button uk-button-small uk-button-primary\">
                        <i class=\"uk-icon uk-icon-edit\"></i> </a>
                    <button type=\"submit\" class=\"uk-button uk-button-small uk-button-danger\"><i class=\"uk-icon uk-icon-trash\"></i>
                    </button>" . Form::close();

    return $html;

}