{!extends file="layout.tpl"!}
{!block name="body"!}

<ul>
{!foreach from=$data["items"] item=item key=key!}
    <li class="li-{!$key!}">{!$item!}</li>
{!/foreach!}
</ul>
{!/block!}



