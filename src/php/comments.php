<div id="comments" class="comments">
<?php if( have_comments() ): //コメントがあったらコメントリストを表示する ?>
<h3 class="widget__title">コメント</h3>
<ol class="commets-list">

<?php wp_list_comments( 'avatar_size=80' ); ?>
</ol>
<?php endif; ?>

<?php $args = array(
'title_reply' => 'コメントする',
'comment_notes_before' => '<p class="before-comments">お気軽にコメントしてください！！</p>',
'comment_notes_after'  => '<p class="required">※メールとお名前は必須です。</p>',
'label_submit' => 'SUBMIT'
);
comment_form( $args ); ?>
</div><!-- #comments -->