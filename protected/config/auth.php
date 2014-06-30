<?php
    return array(
        'guest' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'description' => 'Guest',
            'bizRule' => null,
            'data' => null
        ),
        'user' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'description' => 'User',
            'children' => array(
                'guest',
            ),
            'bizRule' => null,
            'data' => null
        ),
        
        'admin' => array(
            'type' => CAuthItem::TYPE_ROLE,
            'description' => 'Admin',
            'children' => array(
                'user',
            ),
            'bizRule' => null,
            'data' => null
        ),
    );