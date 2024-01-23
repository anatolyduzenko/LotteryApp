{extends file='layouts/admin.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table id="tickets-table" class="w-100">
                <thead>
                    <tr>
                        <th>Ticked ID</th>
                        <th>Drawing Date</th>
                        <th>Ticket Number</th>
                        <th>Winner Name</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$winners item=winner}
                        <tr>
                            <td>{$winner.id}</td>
                            <td>{$winner.drawing_date|date_format:"%Y/%m/%d"}</td>
                            <td>{$winner.ticket.number}</td>
                            <td>{$winner.ticket.user.name}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>
{/block}
