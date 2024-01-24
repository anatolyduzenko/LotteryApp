{extends file='layouts/admin.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center">
            <h1>Tickets list</h1>
            <table id="tickets-table" class="table table-bordered table-hover table-light table-sm w-100">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Drawing Date</th>
                        <th>Ticket Number</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$tickets item=ticket}
                        <tr>
                            <td>{$ticket.id}</td>
                            <td>{$ticket.drawing_date|date_format: 'm-d-Y'}</td>
                            <td>{$ticket.number}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
            {$tickets->links()}
        </div>
    </div>
</div>
{/block}