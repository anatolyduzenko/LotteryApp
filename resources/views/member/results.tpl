{extends file='layouts/smarty.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
    <h1 class="form-signin-heading">Results of today's drawings!</h1>
    {if $is_looser}
        <a href="{route('member.lottery')}" class="btn btn-success btn-lg my-3" id="get-my-luck">Make another attempt!</a>
    {else}        
        <a href="{route('member.lottery')}" class="btn btn-success btn-lg my-3" id="get-back">Back to Lottery</a>
    {/if}
    <div id="lottery-container">
        {if $is_winner}
            <h2>Congratulations!!!</>
            <div id="spinner" class="pb-3">
                <img class="" src="/images/spinner-win.png" />
            </div>
        {elseif $is_looser}
            <h2>We are sorry... :(</h2>
            <div id="spinner" class="pb-3">
                <img class="" src="/images/spinner-not-win.png" />
            </div>
        {/if}
        <hr/>
        <h2>Today's Winners!!!</h2>
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
                        <td>$ {$winner.amount}</td>
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