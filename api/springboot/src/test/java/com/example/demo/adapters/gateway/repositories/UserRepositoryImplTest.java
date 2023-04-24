package com.example.demo.adapters.gateway.repositories;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.orm.jpa.DataJpaTest;

import com.example.demo.domain.model.User;
import com.example.demo.infrastructure.db.jpa.entities.UserJpaEntity;
import com.example.demo.infrastructure.db.jpa.repositories.UserJpaRepository;

import java.util.List;

import static org.junit.jupiter.api.Assertions.assertAll;
import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertNotNull;

@DataJpaTest
class UserRepositoryImplTest {

  @Autowired
  private UserJpaRepository userJpaRepository;

  @Test
  void test_ユーザ情報を正しくデータベースに保存できること() {
    // Arrange
    UserRepositoryImpl userRepositoryImpl = new UserRepositoryImpl(userJpaRepository);
    User expected = new User("John Doe", "john@example.com");

    // Act
    User actual = userRepositoryImpl.save(expected);

    // Assert
    assertNotNull(actual);
    assertEquals(expected.getName(), actual.getName());
    assertEquals(expected.getEmail(), actual.getEmail());

    // データベースにデータが確かに保存されたかを確認
    List<UserJpaEntity> actualFromDatabase = userJpaRepository.findAll();
    assertNotNull(actualFromDatabase);
    assertEquals(1, actualFromDatabase.size());
    assertAll("UserJpaEntity fields",
        () -> assertEquals(expected.getName(), actualFromDatabase.get(0).getName()),
        () -> assertEquals(expected.getEmail(), actualFromDatabase.get(0).getEmail()));
  }
}
