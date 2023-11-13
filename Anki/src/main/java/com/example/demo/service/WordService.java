package com.example.demo.service;

import java.util.Optional;

import com.example.demo.entiry.Word;

public interface WordService {
		//一覧表示
		Iterable<Word> findAll();
		
		//単語IDを取得
		Optional<Word> selectById(Integer id);
		
		//新規追加
		public void insertWord(Word word);
		
		//更新
		public void updateWord(Word word);
		
		//クイズに間違えたらミスカウントを更新
		void updateMisscount(Integer id, Integer newMisscount);
		
		//削除
		public void deleteWord(Integer id);
		
		//ランダムにデータを取得する
		Optional<Word> selectOneRandamWord();
}
