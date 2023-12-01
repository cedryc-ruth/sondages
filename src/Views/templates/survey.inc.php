<div class="survey">

<div class="question">
    <?= $survey->getQuestion() ?>
</div>

<?php foreach ($survey->getResponses() as $response) { ?>
    <div class="response">
        <span class="responseTitle"><?= $response->getTitle() ?></span>
        <span><progress max="100" value="<?= number_format($response->getPercentage(), 2) ?>" class="chart"></progress></span>
        <span class="count"><?= number_format($response->getPercentage(), 2)  ?> %</span>
        <form class="voteForm" method="post" action="index.php?action=Vote">
            <input type="text" hidden name="responseId" value="<?= $response->getId() ?>" >
            <button class="submit">Voter</button>
        </form>
    </div>
<?php } ?>

</div>

