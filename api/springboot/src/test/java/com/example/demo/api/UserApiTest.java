package com.example.demo.api;

import com.example.demo.domain.model.User;
import com.example.demo.infrastructure.db.jpa.entities.UserJpaEntity;
import com.example.demo.infrastructure.db.jpa.repositories.UserJpaRepository;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.MvcResult;
import org.springframework.transaction.annotation.Transactional;

import static org.junit.jupiter.api.Assertions.assertAll;
import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;

@SpringBootTest
@AutoConfigureMockMvc
@Transactional
@ActiveProfiles("apitest")
class UserApiTest {
  @Autowired
  private MockMvc mockMvc;

  @Autowired
  private UserJpaRepository userJpaRepository;

  @Test
  void test_usersAPIでユーザ登録を正常に行えること() throws Exception {
    // Arrange
    int expectedStatus = 201;
    String expectedResponseJson = """
        {
          "name": "John Doe",
          "email": "john@example.com"
        }
        """;
    UserJpaEntity expectedSavedUser = new UserJpaEntity("John Doe", "john@example.com");


    // Act
    MvcResult mvcResult = mockMvc.perform(post("/api/v1/users")
        .contentType("application/json")
        .content("""
            {
              "name": "John Doe",
              "email": "john@example.com"
            }
            """))
        .andReturn();
    ;
    int actualStatus = mvcResult.getResponse().getStatus();
    String actualResponseJson = mvcResult.getResponse().getContentAsString();

    // データベースからデータを取得
    User actualSavedUser = userJpaRepository.findAll().stream()
        .map(UserJpaEntity::toUser)
        .findFirst()
        .orElseThrow(() -> new AssertionError("ユーザーが保存されていません。"));

    // Assert
    assertEquals(expectedStatus, actualStatus);
    assertEquals(
        expectedResponseJson.replaceAll("\\s", ""),
        actualResponseJson.replaceAll("\\s", ""));
    assertAll("UserJpaEntity fields",
        () -> assertEquals(expectedSavedUser.getName(), actualSavedUser.getName()),
        () -> assertEquals(expectedSavedUser.getEmail(), actualSavedUser.getEmail()));
  }
}
