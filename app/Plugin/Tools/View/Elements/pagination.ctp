<div class="text-center">
  <ul class="pagination">
    <?php
      if ($this->Paginator->hasPrev()):
        echo $this->Paginator->prev('&laquo;', array('escape' => false, 'tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
      else:
    ?>
    <li class="disabled"><a href="javascript:void(0)">&laquo;</a></li>
    <?php
      endif;
      echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active'));
      if ($this->Paginator->hasNext()):
        echo $this->Paginator->next('&raquo;', array('escape' => false, 'tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
      else:
    ?>
    <li class="disabled"><a href="javascript:void(0)">&raquo;</a></li>
    <?php endif; ?>
  </ul>
</div>
