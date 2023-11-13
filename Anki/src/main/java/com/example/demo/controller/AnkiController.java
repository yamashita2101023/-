package com.example.demo.controller;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import com.example.demo.entiry.Word;
import com.example.demo.form.WordForm;
import com.example.demo.service.WordService;

@Controller
public class AnkiController {
	@Autowired
	WordService service;
	
	//バリデーションをつける場合に必要になってくる
	@ModelAttribute
    public WordForm setUpWordForm() {
        return new WordForm();
    }
	
	@GetMapping("/ankisys")
	public String ankisysView() {
		return "ankisys";
	}
	
	@GetMapping("/wordquiz")
	public String wordQuizView(Model model) {
	    Optional<Word> wordQuiz = service.selectOneRandamWord(); // 単語を取得
	    model.addAttribute("wordQuizList", wordQuiz); // テンプレートに単語を渡す
	    return "wordquiz";
	}

	
	@GetMapping("/{id}")
	public String showUpdate(WordForm wordForm,@PathVariable Integer id,Model model) {
		//IDをキーにして単語を検索する
		Optional<Word> wordOpt = service.selectById(id);
		
		//検索したデータをWordFormクラスに入れなおす
		Optional<WordForm> wordFormOpt = wordOpt.map(t -> makeWordForm(t));
		
		//WordFormが空で無ければ中身を取り出してwordFormに入れる
		if(wordFormOpt.isPresent()) {
			wordForm = wordFormOpt.get();
		}
		
		model.addAttribute("id",wordForm.getId());
		model.addAttribute("wordForm",wordForm);
		
		return "wordUpdate";
	}
	
	@PostMapping("/delete")
	public String showDelete(@RequestParam("id") Integer id,RedirectAttributes redirectAttributes) {
		service.deleteWord(id);
		redirectAttributes.addFlashAttribute("delcomplete","削除が完了しました");
		return "redirect:/delallword";
	}
	
	@GetMapping("delallword")
	public String delAllWord(Model model) {
		Iterable<Word> list = service.findAll();
		model.addAttribute("wordList",list);
		return "allword";
	}
	
	private WordForm makeWordForm(Word word) {
		WordForm form = new WordForm();
		form.setId(word.getId());
		form.setWorden(word.getWorden());
		form.setWordjp(word.getWordjp());
		return form;
	}
	//単語を追加し、単語一覧画面へ
	@PostMapping("/allword")
	public String allWordView(@Validated WordForm wordform,BindingResult bindingResult,Model model) {
		if(bindingResult.hasErrors()) {
			return "ankisys";
		}
		Word word = new Word(null,wordform.getWorden(),wordform.getWordjp(),0);
		service.insertWord(word);
		Iterable<Word> list = service.findAll();
		model.addAttribute("wordList",list);
		return "allword";
	}
	
	//更新処理とアップデート画面へ
	@PostMapping("/update")
	public String update(@Validated WordForm wordForm,BindingResult bindingResult,Model model,RedirectAttributes redirectAttributes) {
		Word word = new Word();
		word.setId(wordForm.getId());
		word.setWorden(wordForm.getWorden());
		word.setWordjp(wordForm.getWordjp());
		word.setMisscount(wordForm.getMisscount());
		
		if(!bindingResult.hasErrors()) {
			service.updateWord(word);
			redirectAttributes.addFlashAttribute("complete","更新が完了しました");
			return "redirect:" + word.getId();
		}else {
			model.addAttribute("id",wordForm.getId());
			model.addAttribute("wordForm",wordForm);
			return "wordUpdate";
		}
	}
	
	//回答画面へ
	@PostMapping("/answer")
	public String answerView(@RequestParam("word_id") Integer word_id,@RequestParam("worden") String worden,Model model) {

		Optional<Word> wordOpt = service.selectById(word_id);
		if(wordOpt.isPresent()) {
			if(worden.equals(wordOpt.get().getWorden())) {
				model.addAttribute("correct","正解です");
				return "answer";
			}else {
			service.updateMisscount(word_id, wordOpt.get().getMisscount()+1);
			model.addAttribute("noCorrect","不正解です");
			return "answer";
			}
		}
		model.addAttribute("noCorrect","不正解です");
		return "answer";
	}
}
