package com.example.demo.repository;

import org.springframework.data.jdbc.repository.query.Query;
import org.springframework.data.repository.CrudRepository;

import com.example.demo.entiry.Word;

public interface WordCrudRepository extends CrudRepository<Word, Integer> {
	@Query("SELECT id FROM word ORDER BY RAND() limit 1")
	Integer getRandomId();
}
