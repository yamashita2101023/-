package com.example.demo.service;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entiry.Word;
import com.example.demo.repository.WordCrudRepository;


@Service
public class WordServiceImpl implements WordService {
	@Autowired
	WordCrudRepository repository;
	
	@Override
	public Iterable<Word> findAll() {
		// TODO 自動生成されたメソッド・スタブ
		return repository.findAll();
	}
	
	@Override
	public Optional<Word> selectById(Integer id){
		return repository.findById(id);
	}
	
	@Override
	public void insertWord(Word word) {
		repository.save(word);
	}
	
	@Override
	public void updateWord(Word word) {
		repository.save(word);
	}
	
	@Override
	public void updateMisscount(Integer id, Integer newMisscount) {
		Word word = repository.findById(id).orElse(null);
        if (word != null) {
            word.setMisscount(newMisscount);
            repository.save(word);
        }
    }
	
	@Override
	public void deleteWord(Integer id) {
		repository.deleteById(id);
	}
	
	@Override
	public Optional<Word> selectOneRandamWord(){
		Integer randamId = repository.getRandomId();
		
		if(randamId == null) {
			return Optional.empty();
		}
		return repository.findById(randamId);
	}
}
