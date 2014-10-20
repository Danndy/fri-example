<?php

namespace App\Presenters;

use App\Forms\ArticleForm;

class ArticlePresenter extends BasePresenter
{
	/**
	 * @inject
	 * @var \App\Models\ArticleModel
	 */
	public $articleModel;


	/**
	 * @param int $id
	 */
	public function actionDefault($id)
	{
		$article = $this->articleModel->find($id);

		if (!$article)
		{
			$this->error('Article not found.', 404);
		}

		$this->template->article = $article;
	}

	public function renderList()
	{
		$this->template->articles = $this->articleModel->findAll();
	}

	/**
	 * @param int $id
	 */
	public function actionEdit($id)
	{
		$article = $this->articleModel->find($id);

		if (!$article)
		{
			$this->error('Article not found.', 404);
		}

		$this['articleForm']->setDefaults($article);

		$this->setView('add');
	}

	/**
	 * @param int $id
	 */
	public function handleDelete($id)
	{
		$article = $this->articleModel->find($id);

		if (!$article)
		{
			$this->error('Article not found.', 404);
		}

		$this->articleModel->delete($id);

		$this->flashMessage('Článok bol úspešne zmazaný.', 'success');
		$this->redirect('list');
	}

	/**
	 * @param \App\Forms\ArticleForm $form
	 */
	public function articleFormSubmitted(ArticleForm $form)
	{
		$article = $form->getValues(TRUE);

		if ($this->action == 'add')
		{
			$article['published'] = new \DateTime();
		}
		else
		{
			$article['id'] = $this->getParameter('id');
		}

		$this->articleModel->save($article);

		$this->flashMessage('Článok bol úspešne uložený.', 'success');
		$this->redirect('default', $article['id']);
	}

	/**
	 * @return \App\Components\ArticleControl
	 */
	protected function createComponentArticleControl()
	{
		$articleModel = $this->articleModel;

		return new \Nette\Application\UI\Multiplier(function($id) use ($articleModel)
		{
			$article = $articleModel->find($id);

			return new \App\Components\ArticleControl($article);
		});
	}

	/**
	 * @return \App\Forms\ArticleForm
	 */
	protected function createComponentArticleForm()
	{
		$form = new ArticleForm();
		$form->onSuccess[] = callback($this, 'articleFormSubmitted');

		return $form;
	}
}