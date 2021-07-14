<?php

/*
 * 
*/
function show_status($status, $url='#', $opt=[])
{
    $options = [];
    if ($status == 1)
    {
        $options = [
            'text' => 'Isolasi Mandiri',
            'icon' => 'fa-exclamation-triangle',
            'class' => 'btn-warning btn-sm open-statusModal',
        ];
    }
    else if ($status == 2)
    {
        $options = [
            'text' => 'Rumah Sakit',
            'icon' => 'fa-flag',
            'class' => 'btn-danger btn-sm open-statusModal',
        ];
    }
    else if ($status == 3)
    {
        $options = [
            'text' => 'Sembuh',
            'icon' => 'fa-check',
            'class' => 'btn-success btn-sm open-statusModal',
        ];
    }
    else if ($status == 4)
    {
        $options = [
            'text' => 'Meninggal',
            'icon' => 'fa-arrow-right',
            'class' => 'btn-secondary btn-sm open-statusModal',
        ];
    }
    $options['extra'] = " data-url=\"{$url}\"";
    $options = array_merge($options, $opt);

    return btn_action($url, $options);
}

function show_status_modal($status, $id=null)
{
    $options['extra'] = 'data-toggle="modal" data-target="#statusModal"';
    if ($id)
    {
        $options['extra'] .= " data-id=\"{$id}\"";
    }
    return show_status($status, '#', $options);
}

function btn_action($url, $options) 
{
    $_options = [
        'class' => 'btn-primary btn-sm',
        'text'  => 'Text Button',
        'icon'  => 'fa-flag',
    ];

    $options = array_merge($_options, $options);

    $confirm = "";
    if (array_key_exists('confirm', $options))
    {
        $confirm = "onclick=\"return confirm('{$options['confirm']}');\"";
    }

    $extra = "";
    if (array_key_exists('extra', $options))
    {
        $extra = $options['extra'];
    }

    $btn = "<a href=\"{$url}\" {$confirm} {$extra} class=\"btn btn-icon-split {$options['class']}\">";
    $btn .= "<span class=\"icon text-white-50\"><i class=\"fas {$options['icon']}\"></i></span>";
    $btn .= "<span class=\"text\">{$options['text']}</span></a>";

    return $btn;
}

function btn_action_type($url, $type='edit', $options=[])
{
    $url = base_url($url);

    $_options = [];
    if ($type == 'edit')
    {
        $_options = [
            'text' => 'Ubah',
            'icon' => 'fa-edit',
        ];
    }
    else if ($type == 'delete')
    {
        $_options = [
            'text' => 'Hapus',
            'icon' => 'fa-trash',
            'confirm' => 'Yakin menghapus data?',
            'class' => 'btn-danger btn-sm',
        ];
    }
    $options = array_merge($_options, $options);

    return btn_action($url, $options);
}

function select_option($options, $seleted=false, $label=['id', 'nama'])
{
    $out = "";
    foreach($options as $row)
    {
        if (is_object($row))
        {
            $_seleted = $seleted==$row->{$label[0]} ? "selected" : "";
            $out .= "<option {$_seleted} value=\"{$row->{$label[0]}}\">{$row->{$label[1]}}</option>\n";
        }
        else 
        {
            $_seleted = $seleted==$row[$label[0]] ? "selected" : "";
            $out .= "<option {$_seleted} value=\"{$row[$label[0]]}\">{$row[$label[1]]}</option>\n";
        }
    }
    return $out;
}

function role_text($role)
{
    if ($role == 1)
    {
        return 'Administrator';
    }
    else if ($role == 2)
    {
        return 'User';
    }
}

function is_login()
{
    return session()->get('logged_in');
}

function is_admin()
{
    if (session()->get('role') == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
}