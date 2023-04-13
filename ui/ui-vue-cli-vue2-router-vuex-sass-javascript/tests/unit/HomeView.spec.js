import HomeView from "@/views/HomeView";
import HelloWorld from "@/components/HelloWorld";
import { shallowMount } from "@vue/test-utils";

describe("HomeView.spec", () => {
  it("HelloWorldにメッセージを渡すことができる", () => {
    // Arrange
    const expectedMessage = "Hello from parent component!";

    // Act
    const wrapper = shallowMount(HomeView);
    const childWrapper = wrapper.findComponent(HelloWorld);
    const actualMessage = childWrapper.props("msg");

    // Assert
    expect(actualMessage).toBe(expectedMessage);
  });
});
