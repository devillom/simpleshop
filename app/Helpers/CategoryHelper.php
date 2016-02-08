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
                       ' . $node->name . '
                    </div>';

        $html .= '<ul class="uk-nestable-list">';

        foreach ($node->children as $child)
            $html .= renderSortableNode($child);

        $html .= '</ul>';

        $html .= '</li>';
    }

    return $html;
}


function renderNode($node)
{
    if ($node->isLeaf()) {
        return '<li>' . $node->name . '</li>';
    } else {
        $html = '<li>' . $node->name;

        $html .= '<ul>';

        foreach ($node->children as $child)
            $html .= renderNode($child);

        $html .= '</ul>';

        $html .= '</li>';
    }

    return $html;
}