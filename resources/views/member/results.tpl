{extends file='layouts/smarty.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
    <h1 class="form-signin-heading">Fortune results</h1>
    {if $looser}
        <a href="{route('member.lottery')}" class="btn btn-success btn-lg" id="get-my-luck">Make another attempt!</a>
    {/if}
    <div id="lottery-container">
        <div id="spinner">
            {if $is_winner}
                <img class="" src="/images/spinner-win.png" />
            {elseif $is_looser}
                <img class="" src="/images/spinner-not-win.png" />
            {/if}
        </div>
        <table id="results-table" class="w-100">
            <thead>
                <tr>
                    <th>Winner Name</th>
                    <th>Ticket Number</th>
                    <th>Prize</th>
                </tr>
            </thead>
            <tbody>
                {* Loop through winners data *}
                {foreach from=$winners item=winner}
                    <tr>
                        <td>{$winner.ticket.user.name}</td>
                        <td>{$winner.ticket.number}</td>
                        <td>{$winner.amount}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}
{block name=scripts}
    <script type="text/javascript" >
        $(document).ready(function(){
        });
    </script>
{/block}