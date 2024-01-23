{extends file='layouts/smarty.tpl'}
{block name=title}Welcome to the Lottery!{/block}
{block name=contents}
    <h1 class="form-signin-heading py=10">Next Lottery starts at {$next_date}!</h1>
    <div id="lottery-container">
        <div id="spinner">
            {* Spinner placeholder *}
            <img class="" src="/images/spinner.png" />
        </div>
        <h2>Our latest winners!</h2>
        <table id="results-table" class="w-100">
            <thead>
                <tr>
                    <th>Winner Name</th>
                    <th>Drawing Date</th>
                    <th>Ticket Number</th>
                </tr>
            </thead>
            <tbody>
                {* Loop through winners data *}
                {foreach from=$winners item=winner}
                    <tr>
                        <td>{$winner.name}</td>
                        <td>{$winner.date_drawing}</td>
                        <td>{$winner.amount}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}