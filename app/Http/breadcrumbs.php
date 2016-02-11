<?php

Breadcrumbs::register('manager.index', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('manager.index'));
});

Breadcrumbs::register('manager.user.index', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.index');
    $breadcrumbs->push('Пользователи', route('manager.user.index'));
});

Breadcrumbs::register('manager.user.edit', function($breadcrumbs,$user)
{
    $breadcrumbs->parent('manager.user.index');
    $breadcrumbs->push('Редактировать', route('manager.user.edit',$user->id));
});

Breadcrumbs::register('manager.user.create', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.user.index');
    $breadcrumbs->push('Добавить', route('manager.user.create'));
});



Breadcrumbs::register('manager.shop.category.index', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.index');
    $breadcrumbs->push('Категории', route('manager.shop.category.index'));
});

Breadcrumbs::register('manager.shop.category.create', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.shop.category.index');
    $breadcrumbs->push('Добавить', route('manager.shop.category.create'));
});


Breadcrumbs::register('manager.shop.category.edit', function($breadcrumbs,$category)
{
    $breadcrumbs->parent('manager.shop.category.index');
    $breadcrumbs->push('Редактировать', route('manager.shop.category.edit',$category->id));
});

Breadcrumbs::register('manager.shop.category.reorder', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.shop.category.index');
    $breadcrumbs->push('Сортировать', route('manager.shop.category.reorder'));
});


Breadcrumbs::register('manager.shop.product.index', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.index');
    $breadcrumbs->push('Товары', route('manager.shop.product.index'));
});

Breadcrumbs::register('manager.shop.product.edit', function($breadcrumbs,$product)
{
    $breadcrumbs->parent('manager.shop.product.index');
    $breadcrumbs->push('Редактировать', route('manager.shop.product.edit',$product->id));
});

Breadcrumbs::register('manager.shop.product.create', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.shop.product.index');
    $breadcrumbs->push('Добавить', route('manager.shop.product.create'));
});


Breadcrumbs::register('field.index', function($breadcrumbs)
{
    $breadcrumbs->parent('manager.index');
    $breadcrumbs->push('Дополнительные поля', route('field.index'));
});
